class mx.video.VideoPlayer extends MovieClip
{
   static var version = "1.0.0.94";
   static var DISCONNECTED = "disconnected";
   static var STOPPED = "stopped";
   static var PLAYING = "playing";
   static var PAUSED = "paused";
   static var BUFFERING = "buffering";
   static var LOADING = "loading";
   static var CONNECTION_ERROR = "connectionError";
   static var REWINDING = "rewinding";
   static var SEEKING = "seeking";
   static var RESIZING = "resizing";
   static var EXEC_QUEUED_CMD = "execQueuedCmd";
   static var BUFFER_EMPTY = "bufferEmpty";
   static var BUFFER_FULL = "bufferFull";
   static var BUFFER_FULL_SAW_PLAY_STOP = "bufferFullSawPlayStop";
   static var DEFAULT_INCMANAGER = "mx.video.NCManager";
   static var DEFAULT_UPDATE_TIME_INTERVAL = 250;
   static var DEFAULT_UPDATE_PROGRESS_INTERVAL = 250;
   static var DEFAULT_IDLE_TIMEOUT_INTERVAL = 300000;
   static var AUTO_RESIZE_INTERVAL = 100;
   static var AUTO_RESIZE_PLAYHEAD_TIMEOUT = 0.5;
   static var AUTO_RESIZE_METADATA_DELAY_MAX = 2;
   static var FINISH_AUTO_RESIZE_INTERVAL = 250;
   static var RTMP_DO_STOP_AT_END_INTERVAL = 500;
   static var RTMP_DO_SEEK_INTERVAL = 100;
   static var HTTP_DO_SEEK_INTERVAL = 250;
   static var HTTP_DO_SEEK_MAX_COUNT = 4;
   static var CLOSE_NS_INTERVAL = 0.25;
   static var HTTP_DELAYED_BUFFERING_INTERVAL = 100;
   static var PLAY = 0;
   static var LOAD = 1;
   static var PAUSE = 2;
   static var STOP = 3;
   static var SEEK = 4;
   function VideoPlayer()
   {
      super();
      mx.events.EventDispatcher.initialize(this);
      this._state = mx.video.VideoPlayer.DISCONNECTED;
      this._cachedState = this._state;
      this._bufferState = mx.video.VideoPlayer.BUFFER_EMPTY;
      this._cachedPlayheadTime = 0;
      this._metadata = null;
      this._startingPlay = false;
      this._invalidSeekTime = false;
      this._currentPos = 0;
      this._atEnd = false;
      this._cmdQueue = new Array();
      this._readyDispatched = false;
      this._autoResizeDone = false;
      this._lastUpdateTime = -1;
      this._sawSeekNotify = false;
      this._updateTimeIntervalID = 0;
      this._updateTimeInterval = mx.video.VideoPlayer.DEFAULT_UPDATE_TIME_INTERVAL;
      this._updateProgressIntervalID = 0;
      this._updateProgressInterval = mx.video.VideoPlayer.DEFAULT_UPDATE_PROGRESS_INTERVAL;
      this._idleTimeoutIntervalID = 0;
      this._idleTimeoutInterval = mx.video.VideoPlayer.DEFAULT_IDLE_TIMEOUT_INTERVAL;
      this._autoResizeIntervalID = 0;
      this._rtmpDoStopAtEndIntervalID = 0;
      this._rtmpDoSeekIntervalID = 0;
      this._httpDoSeekIntervalID = 0;
      this._httpDoSeekCount = 0;
      this._finishAutoResizeIntervalID = 0;
      this._delayedBufferingIntervalID = 0;
      this._delayedBufferingInterval = mx.video.VideoPlayer.HTTP_DELAYED_BUFFERING_INTERVAL;
      if(this._isLive == undefined)
      {
         this._isLive = false;
      }
      if(this._autoSize == undefined)
      {
         this._autoSize = false;
      }
      if(this._aspectRatio == undefined)
      {
         this._aspectRatio = true;
      }
      if(this._autoPlay == undefined)
      {
         this._autoPlay = true;
      }
      if(this._autoRewind == undefined)
      {
         this._autoRewind = true;
      }
      if(this._bufferTime == undefined)
      {
         this._bufferTime = 0.1;
      }
      if(this._volume == undefined)
      {
         this._volume = 100;
      }
      this._sound = new Sound(this);
      this._sound.setVolume(this._volume);
      this.__visible = true;
      this._hiddenForResize = false;
      this._hiddenForResizeMetadataDelay = 0;
      this._contentPath = "";
   }
   function setSize(w, h)
   {
      if(w == this._video._width && h == this._video._height || this._autoSize)
      {
         return undefined;
      }
      this._video._width = w;
      this._video._height = h;
      if(this._aspectRatio)
      {
         this.startAutoResize();
      }
   }
   function setScale(xs, ys)
   {
      if(xs == this._video._xscale && ys == this._video._yscale || this._autoSize)
      {
         return undefined;
      }
      this._video._xscale = xs;
      this._video._yscale = ys;
      if(this._aspectRatio)
      {
         this.startAutoResize();
      }
   }
   function play(url, isLive, totalTime)
   {
      if(url != null && url != undefined)
      {
         if(this._state == mx.video.VideoPlayer.EXEC_QUEUED_CMD)
         {
            this._state = this._cachedState;
         }
         else
         {
            if(!this.__get__stateResponsive())
            {
               this.queueCmd(mx.video.VideoPlayer.PLAY,url,isLive,totalTime);
               return undefined;
            }
            this.execQueuedCmds();
         }
         this._autoPlay = true;
         this._load(url,isLive,totalTime);
         return undefined;
      }
      if(!this.isXnOK())
      {
         if(this._state == mx.video.VideoPlayer.CONNECTION_ERROR || this._ncMgr == null || this._ncMgr == undefined || this._ncMgr.getNetConnection() == null || this._ncMgr.getNetConnection() == undefined)
         {
            throw new mx.video.VideoError(mx.video.VideoError.NO_CONNECTION);
         }
         else
         {
            this.flushQueuedCmds();
            this.queueCmd(mx.video.VideoPlayer.PLAY);
            this.setState(mx.video.VideoPlayer.LOADING);
            this._cachedState = mx.video.VideoPlayer.LOADING;
            this._ncMgr.reconnect();
            return undefined;
         }
      }
      else
      {
         if(this._state == mx.video.VideoPlayer.EXEC_QUEUED_CMD)
         {
            this._state = this._cachedState;
         }
         else
         {
            if(!this.__get__stateResponsive())
            {
               this.queueCmd(mx.video.VideoPlayer.PLAY);
               return undefined;
            }
            this.execQueuedCmds();
         }
         if(this._ns == null || this._ns == undefined)
         {
            this._createStream();
            this._video.attachVideo(this._ns);
            this.attachAudio(this._ns);
         }
         switch(this._state)
         {
            case mx.video.VideoPlayer.BUFFERING:
               if(this._ncMgr.isRTMP())
               {
                  this._play(0);
                  if(this._atEnd)
                  {
                     this._atEnd = false;
                     this._currentPos = 0;
                     this.setState(mx.video.VideoPlayer.REWINDING);
                  }
                  else if(this._currentPos > 0)
                  {
                     this._seek(this._currentPos);
                     this._currentPos = 0;
                  }
               }
            case mx.video.VideoPlayer.PLAYING:
               return undefined;
               break;
            case mx.video.VideoPlayer.STOPPED:
               if(this._ncMgr.isRTMP())
               {
                  if(this._isLive)
                  {
                     this._play(-1);
                     this.setState(mx.video.VideoPlayer.BUFFERING);
                  }
                  else
                  {
                     this._play(0);
                     if(this._atEnd)
                     {
                        this._atEnd = false;
                        this._currentPos = 0;
                        this._state = mx.video.VideoPlayer.BUFFERING;
                        this.setState(mx.video.VideoPlayer.REWINDING);
                     }
                     else if(this._currentPos > 0)
                     {
                        this._seek(this._currentPos);
                        this._currentPos = 0;
                        this.setState(mx.video.VideoPlayer.BUFFERING);
                     }
                     else
                     {
                        this.setState(mx.video.VideoPlayer.BUFFERING);
                     }
                  }
               }
               else
               {
                  this._pause(false);
                  if(this._atEnd)
                  {
                     this._atEnd = false;
                     this._seek(0);
                     this._state = mx.video.VideoPlayer.BUFFERING;
                     this.setState(mx.video.VideoPlayer.REWINDING);
                  }
                  else if(this._bufferState == mx.video.VideoPlayer.BUFFER_EMPTY)
                  {
                     this.setState(mx.video.VideoPlayer.BUFFERING);
                  }
                  else
                  {
                     this.setState(mx.video.VideoPlayer.PLAYING);
                  }
               }
               break;
            case mx.video.VideoPlayer.PAUSED:
               this._pause(false);
               if(!this._ncMgr.isRTMP())
               {
                  if(this._bufferState == mx.video.VideoPlayer.BUFFER_EMPTY)
                  {
                     this.setState(mx.video.VideoPlayer.BUFFERING);
                  }
                  else
                  {
                     this.setState(mx.video.VideoPlayer.PLAYING);
                  }
               }
               else
               {
                  this.setState(mx.video.VideoPlayer.BUFFERING);
               }
         }
      }
   }
   function load(url, isLive, totalTime)
   {
      if(url == null || url == undefined)
      {
         throw new Error("null url sent to VideoPlayer.load");
      }
      else
      {
         if(this._state == mx.video.VideoPlayer.EXEC_QUEUED_CMD)
         {
            this._state = this._cachedState;
         }
         else
         {
            if(!this.__get__stateResponsive())
            {
               this.queueCmd(mx.video.VideoPlayer.LOAD,url,isLive,totalTime);
               return undefined;
            }
            this.execQueuedCmds();
         }
         this._autoPlay = false;
         this._load(url,isLive,totalTime);
      }
   }
   function _load(url, isLive, totalTime)
   {
      this._prevVideoWidth = this.videoWidth;
      if(this._prevVideoWidth == undefined)
      {
         this._prevVideoWidth = this._video.width;
         if(this._prevVideoWidth == undefined)
         {
            this._prevVideoWidth = 0;
         }
      }
      this._prevVideoHeight = this.videoHeight;
      if(this._prevVideoHeight == undefined)
      {
         this._prevVideoHeight = this._video.height;
         if(this._prevVideoHeight == undefined)
         {
            this._prevVideoHeight = 0;
         }
      }
      this._autoResizeDone = false;
      this._cachedPlayheadTime = 0;
      this._bufferState = mx.video.VideoPlayer.BUFFER_EMPTY;
      this._metadata = null;
      this._startingPlay = false;
      this._invalidSeekTime = false;
      this._isLive = isLive;
      this._contentPath = url;
      this._currentPos = 0;
      this._streamLength = totalTime;
      this._atEnd = false;
      this._videoWidth = undefined;
      this._videoHeight = undefined;
      this._readyDispatched = false;
      this._lastUpdateTime = -1;
      this._sawSeekNotify = false;
      clearInterval(this._updateTimeIntervalID);
      this._updateTimeIntervalID = 0;
      clearInterval(this._updateProgressIntervalID);
      this._updateProgressIntervalID = 0;
      clearInterval(this._idleTimeoutIntervalID);
      this._idleTimeoutIntervalID = 0;
      clearInterval(this._autoResizeIntervalID);
      this._autoResizeIntervalID = 0;
      clearInterval(this._rtmpDoStopAtEndIntervalID);
      this._rtmpDoStopAtEndIntervalID = 0;
      clearInterval(this._rtmpDoSeekIntervalID);
      this._rtmpDoSeekIntervalID = 0;
      clearInterval(this._httpDoSeekIntervalID);
      this._httpDoSeekIntervalID = 0;
      clearInterval(this._finishAutoResizeIntervalID);
      this._finishAutoResizeIntervalID = 0;
      clearInterval(this._delayedBufferingIntervalID);
      this._delayedBufferingIntervalID = 0;
      this.closeNS(false);
      if(this._ncMgr == null || this._ncMgr == undefined)
      {
         this.createINCManager();
      }
      var _loc2_ = this._ncMgr.connectToURL(this._contentPath);
      this.setState(mx.video.VideoPlayer.LOADING);
      this._cachedState = mx.video.VideoPlayer.LOADING;
      if(_loc2_)
      {
         this._createStream();
         this._setUpStream();
      }
      if(!this._ncMgr.isRTMP())
      {
         clearInterval(this._updateProgressIntervalID);
         this._updateProgressIntervalID = setInterval(this,"doUpdateProgress",this._updateProgressInterval);
      }
   }
   function pause()
   {
      if(!this.isXnOK())
      {
         if(this._state == mx.video.VideoPlayer.CONNECTION_ERROR || this._ncMgr == null || this._ncMgr == undefined || this._ncMgr.getNetConnection() == null || this._ncMgr.getNetConnection() == undefined)
         {
            throw new mx.video.VideoError(mx.video.VideoError.NO_CONNECTION);
         }
         else
         {
            return undefined;
         }
      }
      else
      {
         if(this._state == mx.video.VideoPlayer.EXEC_QUEUED_CMD)
         {
            this._state = this._cachedState;
         }
         else
         {
            if(!this.__get__stateResponsive())
            {
               this.queueCmd(mx.video.VideoPlayer.PAUSE);
               return undefined;
            }
            this.execQueuedCmds();
         }
         if(this._state == mx.video.VideoPlayer.PAUSED || this._state == mx.video.VideoPlayer.STOPPED || this._ns == null || this._ns == undefined)
         {
            return undefined;
         }
         this._pause(true);
         this.setState(mx.video.VideoPlayer.PAUSED);
      }
   }
   function stop()
   {
      if(!this.isXnOK())
      {
         if(this._state == mx.video.VideoPlayer.CONNECTION_ERROR || this._ncMgr == null || this._ncMgr == undefined || this._ncMgr.getNetConnection() == null || this._ncMgr.getNetConnection() == undefined)
         {
            throw new mx.video.VideoError(mx.video.VideoError.NO_CONNECTION);
         }
         else
         {
            return undefined;
         }
      }
      else
      {
         if(this._state == mx.video.VideoPlayer.EXEC_QUEUED_CMD)
         {
            this._state = this._cachedState;
         }
         else
         {
            if(!this.__get__stateResponsive())
            {
               this.queueCmd(mx.video.VideoPlayer.STOP);
               return undefined;
            }
            this.execQueuedCmds();
         }
         if(this._state == mx.video.VideoPlayer.STOPPED || this._ns == null || this._ns == undefined)
         {
            return undefined;
         }
         if(this._ncMgr.isRTMP())
         {
            if(this._autoRewind && !this._isLive)
            {
               this._currentPos = 0;
               this._play(0,0);
               this._state = mx.video.VideoPlayer.STOPPED;
               this.setState(mx.video.VideoPlayer.REWINDING);
            }
            else
            {
               this.closeNS(true);
               this.setState(mx.video.VideoPlayer.STOPPED);
            }
         }
         else
         {
            this._pause(true);
            if(this._autoRewind)
            {
               this._seek(0);
               this._state = mx.video.VideoPlayer.STOPPED;
               this.setState(mx.video.VideoPlayer.REWINDING);
            }
            else
            {
               this.setState(mx.video.VideoPlayer.STOPPED);
            }
         }
      }
   }
   function seek(time)
   {
      if(isNaN(time) || time < 0)
      {
         throw new mx.video.VideoError(mx.video.VideoError.INVALID_SEEK);
      }
      else if(!this.isXnOK())
      {
         if(this._state == mx.video.VideoPlayer.CONNECTION_ERROR || this._ncMgr == null || this._ncMgr == undefined || this._ncMgr.getNetConnection() == null || this._ncMgr.getNetConnection() == undefined)
         {
            throw new mx.video.VideoError(mx.video.VideoError.NO_CONNECTION);
         }
         else
         {
            this.flushQueuedCmds();
            this.queueCmd(mx.video.VideoPlayer.SEEK,null,false,time);
            this.setState(mx.video.VideoPlayer.LOADING);
            this._cachedState = mx.video.VideoPlayer.LOADING;
            this._ncMgr.reconnect();
            return undefined;
         }
      }
      else
      {
         if(this._state == mx.video.VideoPlayer.EXEC_QUEUED_CMD)
         {
            this._state = this._cachedState;
         }
         else
         {
            if(!this.__get__stateResponsive())
            {
               this.queueCmd(mx.video.VideoPlayer.SEEK,null,false,time);
               return undefined;
            }
            this.execQueuedCmds();
         }
         if(this._ns == null || this._ns == undefined)
         {
            this._createStream();
            this._video.attachVideo(this._ns);
            this.attachAudio(this._ns);
         }
         if(this._atEnd && time < this.__get__playheadTime())
         {
            this._atEnd = false;
         }
         switch(this._state)
         {
            case mx.video.VideoPlayer.PLAYING:
               this._state = mx.video.VideoPlayer.BUFFERING;
            case mx.video.VideoPlayer.BUFFERING:
            case mx.video.VideoPlayer.PAUSED:
               this._seek(time);
               this.setState(mx.video.VideoPlayer.SEEKING);
               break;
            case mx.video.VideoPlayer.STOPPED:
               if(this._ncMgr.isRTMP())
               {
                  this._play(0);
                  this._pause(true);
               }
               this._seek(time);
               this._state = mx.video.VideoPlayer.PAUSED;
               this.setState(mx.video.VideoPlayer.SEEKING);
         }
      }
   }
   function close()
   {
      this.closeNS(true);
      if(this._ncMgr != null && this._ncMgr != undefined && this._ncMgr.isRTMP())
      {
         this._ncMgr.close();
      }
      this.setState(mx.video.VideoPlayer.DISCONNECTED);
      this.dispatchEvent({type:"close",state:this._state,playheadTime:this.__get__playheadTime()});
   }
   function __get__x()
   {
      return this._x;
   }
   function __set__x(xpos)
   {
      this._x = xpos;
      return this.__get__x();
   }
   function __get__y()
   {
      return this._y;
   }
   function __set__y(ypos)
   {
      this._y = ypos;
      return this.__get__y();
   }
   function __get__scaleX()
   {
      return this._video._xscale;
   }
   function __set__scaleX(xs)
   {
      this.setScale(xs,this.__get__scaleY());
      return this.__get__scaleX();
   }
   function __get__scaleY()
   {
      return this._video._yscale;
   }
   function __set__scaleY(ys)
   {
      this.setScale(this.__get__scaleX(),ys);
      return this.__get__scaleY();
   }
   function __get__width()
   {
      return this._video._width;
   }
   function __set__width(w)
   {
      this.setSize(w,this._video._height);
      return this.__get__width();
   }
   function __get__height()
   {
      return this._video._height;
   }
   function __set__height(h)
   {
      this.setSize(this._video._width,h);
      return this.__get__height();
   }
   function __get__videoWidth()
   {
      if(this._readyDispatched)
      {
         this._videoWidth = this._video.width;
      }
      return this._videoWidth;
   }
   function __get__videoHeight()
   {
      if(this._readyDispatched)
      {
         this._videoHeight = this._video.height;
      }
      return this._videoHeight;
   }
   function __get__visible()
   {
      if(!this._hiddenForResize)
      {
         this.__visible = this._visible;
      }
      return this.__visible;
   }
   function __set__visible(v)
   {
      this.__visible = v;
      if(!this._hiddenForResize)
      {
         this._visible = this.__visible;
      }
      return this.__get__visible();
   }
   function __get__autoSize()
   {
      return this._autoSize;
   }
   function __set__autoSize(flag)
   {
      if(this._autoSize != flag)
      {
         this._autoSize = flag;
         if(this._autoSize)
         {
            this.startAutoResize();
         }
      }
      return this.__get__autoSize();
   }
   function __get__maintainAspectRatio()
   {
      return this._aspectRatio;
   }
   function __set__maintainAspectRatio(flag)
   {
      if(this._aspectRatio != flag)
      {
         this._aspectRatio = flag;
         if(this._aspectRatio && !this._autoSize)
         {
            this.startAutoResize();
         }
      }
      return this.__get__maintainAspectRatio();
   }
   function __get__autoRewind()
   {
      return this._autoRewind;
   }
   function __set__autoRewind(flag)
   {
      this._autoRewind = flag;
      return this.__get__autoRewind();
   }
   function __get__playheadTime()
   {
      var _loc2_ = !(this._ns == null || this._ns == undefined)?this._ns.time:this._currentPos;
      if(this._metadata.audiodelay != undefined)
      {
         _loc2_ = _loc2_ - this._metadata.audiodelay;
         if(_loc2_ < 0)
         {
            _loc2_ = 0;
         }
      }
      return _loc2_;
   }
   function __set__playheadTime(position)
   {
      this.seek(position);
      return this.__get__playheadTime();
   }
   function __get__url()
   {
      return this._contentPath;
   }
   function __get__volume()
   {
      return this._volume;
   }
   function __set__volume(aVol)
   {
      this._volume = aVol;
      if(!this._hiddenForResize)
      {
         this._sound.setVolume(this._volume);
      }
      return this.__get__volume();
   }
   function __get__transform()
   {
      return this._sound.getTransform();
   }
   function __set__transform(s)
   {
      this._sound.setTransform(s);
      return this.__get__transform();
   }
   function __get__isRTMP()
   {
      if(this._ncMgr == null || this._ncMgr == undefined)
      {
         return true;
      }
      return this._ncMgr.isRTMP();
   }
   function __get__isLive()
   {
      return this._isLive;
   }
   function __get__state()
   {
      return this._state;
   }
   function __get__stateResponsive()
   {
      switch(this._state)
      {
         case mx.video.VideoPlayer.DISCONNECTED:
         case mx.video.VideoPlayer.STOPPED:
         case mx.video.VideoPlayer.PLAYING:
         case mx.video.VideoPlayer.PAUSED:
         case mx.video.VideoPlayer.BUFFERING:
            break;
         default:
            return false;
      }
      return true;
   }
   function __get__bytesLoaded()
   {
      if(this._ns == null || this._ns == undefined || this._ncMgr.isRTMP())
      {
         return -1;
      }
      return this._ns.bytesLoaded;
   }
   function __get__bytesTotal()
   {
      if(this._ns == null || this._ns == undefined || this._ncMgr.isRTMP())
      {
         return -1;
      }
      return this._ns.bytesTotal;
   }
   function __get__totalTime()
   {
      return this._streamLength;
   }
   function __get__bufferTime()
   {
      return this._bufferTime;
   }
   function __set__bufferTime(aTime)
   {
      this._bufferTime = aTime;
      if(this._ns != null && this._ns != undefined)
      {
         this._ns.setBufferTime(this._bufferTime);
      }
      return this.__get__bufferTime();
   }
   function __get__idleTimeout()
   {
      return this._idleTimeoutInterval;
   }
   function __set__idleTimeout(aTime)
   {
      this._idleTimeoutInterval = aTime;
      if(this._idleTimeoutIntervalID > 0)
      {
         clearInterval(this._idleTimeoutIntervalID);
         this._idleTimeoutIntervalID = setInterval(this,"doIdleTimeout",this._idleTimeoutInterval);
      }
      return this.__get__idleTimeout();
   }
   function __get__playheadUpdateInterval()
   {
      return this._updateTimeInterval;
   }
   function __set__playheadUpdateInterval(aTime)
   {
      this._updateTimeInterval = aTime;
      if(this._updateTimeIntervalID > 0)
      {
         clearInterval(this._updateTimeIntervalID);
         this._updateTimeIntervalID = setInterval(this,"doUpdateTime",this._updateTimeInterval);
      }
      return this.__get__playheadUpdateInterval();
   }
   function __get__progressInterval()
   {
      return this._updateProgressInterval;
   }
   function __set__progressInterval(aTime)
   {
      this._updateProgressInterval = aTime;
      if(this._updateProgressIntervalID > 0)
      {
         clearInterval(this._updateProgressIntervalID);
         this._updateProgressIntervalID = setInterval(this,"doUpdateProgress",this._updateProgressInterval);
      }
      return this.__get__progressInterval();
   }
   function __get__ncMgr()
   {
      if(this._ncMgr == null || this._ncMgr == undefined)
      {
         this.createINCManager();
      }
      return this._ncMgr;
   }
   function __get__metadata()
   {
      return this._metadata;
   }
   function doUpdateTime()
   {
      var _loc2_ = this.__get__playheadTime();
      switch(this._state)
      {
         case mx.video.VideoPlayer.STOPPED:
         case mx.video.VideoPlayer.PAUSED:
         case mx.video.VideoPlayer.DISCONNECTED:
         case mx.video.VideoPlayer.CONNECTION_ERROR:
            break;
         default:
            if(this._lastUpdateTime != _loc2_)
            {
               this.dispatchEvent({type:"playheadUpdate",state:this._state,playheadTime:_loc2_});
               this._lastUpdateTime = _loc2_;
            }
      }
      clearInterval(this._updateTimeIntervalID);
      this._updateTimeIntervalID = 0;
      if(this._lastUpdateTime != _loc2_)
      {
         this.dispatchEvent({type:"playheadUpdate",state:this._state,playheadTime:_loc2_});
         this._lastUpdateTime = _loc2_;
      }
   }
   function doUpdateProgress()
   {
      if(this._ns == null || this._ns == undefined)
      {
         return undefined;
      }
      if(this._ns.bytesTotal >= 0 && this._ns.bytesTotal >= 0)
      {
         this.dispatchEvent({type:"progress",bytesLoaded:this._ns.bytesLoaded,bytesTotal:this._ns.bytesTotal});
      }
      if(this._state == mx.video.VideoPlayer.DISCONNECTED || this._state == mx.video.VideoPlayer.CONNECTION_ERROR || this._ns.bytesLoaded == this._ns.bytesTotal)
      {
         clearInterval(this._updateProgressIntervalID);
         this._updateProgressIntervalID = 0;
      }
   }
   function rtmpOnStatus(info)
   {
      if(this._state == mx.video.VideoPlayer.CONNECTION_ERROR)
      {
         return undefined;
      }
      switch(info.code)
      {
         case "NetStream.Play.Stop":
            if(this._startingPlay)
            {
               return undefined;
            }
            switch(this._state)
            {
               case mx.video.VideoPlayer.RESIZING:
                  if(this._hiddenForResize)
                  {
                     this.finishAutoResize();
                  }
                  break;
               case mx.video.VideoPlayer.LOADING:
               case mx.video.VideoPlayer.STOPPED:
               case mx.video.VideoPlayer.PAUSED:
                  break;
               default:
                  if(this._bufferState == mx.video.VideoPlayer.BUFFER_EMPTY || this._bufferTime <= 0.1)
                  {
                     this._cachedPlayheadTime = this.playheadTime;
                     clearInterval(this._rtmpDoStopAtEndIntervalID);
                     this._rtmpDoStopAtEndIntervalID = setInterval(this,"rtmpDoStopAtEnd",mx.video.VideoPlayer.RTMP_DO_STOP_AT_END_INTERVAL);
                  }
                  else if(this._bufferState == mx.video.VideoPlayer.BUFFER_FULL)
                  {
                     this._bufferState = mx.video.VideoPlayer.BUFFER_FULL_SAW_PLAY_STOP;
                  }
            }
            break;
         case "NetStream.Buffer.Empty":
            switch(this._bufferState)
            {
               case mx.video.VideoPlayer.BUFFER_FULL_SAW_PLAY_STOP:
                  this.rtmpDoStopAtEnd(true);
                  break;
               case mx.video.VideoPlayer.BUFFER_FULL:
                  if(this._state == mx.video.VideoPlayer.PLAYING)
                  {
                     this.setState(mx.video.VideoPlayer.BUFFERING);
                  }
            }
            this._bufferState = mx.video.VideoPlayer.BUFFER_EMPTY;
            break;
         case "NetStream.Buffer.Flush":
         case "NetStream.Buffer.Full":
            if(this._sawSeekNotify && this._state == mx.video.VideoPlayer.SEEKING)
            {
               this._bufferState = mx.video.VideoPlayer.BUFFER_EMPTY;
               this.setStateFromCachedState();
               this.doUpdateTime();
            }
            if((_loc0_ = this._bufferState) === mx.video.VideoPlayer.BUFFER_EMPTY)
            {
               if(!this._hiddenForResize && (this._state == mx.video.VideoPlayer.LOADING && this._cachedState == mx.video.VideoPlayer.PLAYING || this._state == mx.video.VideoPlayer.BUFFERING))
               {
                  this.setState(mx.video.VideoPlayer.PLAYING);
               }
               this._bufferState = mx.video.VideoPlayer.BUFFER_FULL;
            }
            break;
         case "NetStream.Pause.Notify":
            if(this._state == mx.video.VideoPlayer.RESIZING && this._hiddenForResize)
            {
               this.finishAutoResize();
            }
            break;
         case "NetStream.Play.Start":
            clearInterval(this._rtmpDoStopAtEndIntervalID);
            this._rtmpDoStopAtEndIntervalID = 0;
            this._bufferState = mx.video.VideoPlayer.BUFFER_EMPTY;
            if(this._startingPlay)
            {
               this._startingPlay = false;
               this._cachedPlayheadTime = this.playheadTime;
            }
            else if(this._state == mx.video.VideoPlayer.PLAYING)
            {
               this.setState(mx.video.VideoPlayer.BUFFERING);
            }
            break;
         case "NetStream.Play.Reset":
            clearInterval(this._rtmpDoStopAtEndIntervalID);
            this._rtmpDoStopAtEndIntervalID = 0;
            if(this._state == mx.video.VideoPlayer.REWINDING)
            {
               clearInterval(this._rtmpDoSeekIntervalID);
               this._rtmpDoSeekIntervalID = 0;
               if(this.__get__playheadTime() == 0 || this.__get__playheadTime() < this._cachedPlayheadTime)
               {
                  this.setStateFromCachedState();
               }
               else
               {
                  this._cachedPlayheadTime = this.playheadTime;
                  this._rtmpDoSeekIntervalID = setInterval(this,"rtmpDoSeek",mx.video.VideoPlayer.RTMP_DO_SEEK_INTERVAL);
               }
            }
            break;
         case "NetStream.Seek.Notify":
            if(this.__get__playheadTime() != this._cachedPlayheadTime)
            {
               this.setStateFromCachedState();
               this.doUpdateTime();
            }
            else
            {
               this._sawSeekNotify = true;
               if(this._rtmpDoSeekIntervalID == 0)
               {
                  this._rtmpDoSeekIntervalID = setInterval(this,"rtmpDoSeek",mx.video.VideoPlayer.RTMP_DO_SEEK_INTERVAL);
               }
            }
            break;
         case "Netstream.Play.UnpublishNotify":
            break;
         case "Netstream.Play.PublishNotify":
            break;
         case "NetStream.Play.StreamNotFound":
            if(!this._ncMgr.connectAgain())
            {
               this.setState(mx.video.VideoPlayer.CONNECTION_ERROR);
            }
            break;
         case "NetStream.Play.Failed":
         case "NetStream.Failed":
            this.setState(mx.video.VideoPlayer.CONNECTION_ERROR);
      }
   }
   function httpOnStatus(info)
   {
      switch(info.code)
      {
         case "NetStream.Play.Stop":
            clearInterval(this._delayedBufferingIntervalID);
            this._delayedBufferingIntervalID = 0;
            if(this._invalidSeekTime)
            {
               this._invalidSeekTime = false;
               this.setState(this._cachedState);
               this.seek(this.__get__playheadTime());
            }
            else
            {
               switch(this._state)
               {
                  case mx.video.VideoPlayer.PLAYING:
                  case mx.video.VideoPlayer.BUFFERING:
                  case mx.video.VideoPlayer.SEEKING:
               }
               this.httpDoStopAtEnd();
            }
            break;
         case "NetStream.Seek.InvalidTime":
            this._invalidSeekTime = true;
            break;
         case "NetStream.Buffer.Empty":
            this._bufferState = mx.video.VideoPlayer.BUFFER_EMPTY;
            if(this._state == mx.video.VideoPlayer.PLAYING)
            {
               clearInterval(this._delayedBufferingIntervalID);
               this._delayedBufferingIntervalID = setInterval(this,"doDelayedBuffering",this._delayedBufferingInterval);
            }
            break;
         case "NetStream.Buffer.Full":
         case "NetStream.Buffer.Flush":
            clearInterval(this._delayedBufferingIntervalID);
            this._delayedBufferingIntervalID = 0;
            this._bufferState = mx.video.VideoPlayer.BUFFER_FULL;
            if(!this._hiddenForResize && (this._state == mx.video.VideoPlayer.LOADING && this._cachedState == mx.video.VideoPlayer.PLAYING || this._state == mx.video.VideoPlayer.BUFFERING))
            {
               this.setState(mx.video.VideoPlayer.PLAYING);
            }
            break;
         case "NetStream.Seek.Notify":
            switch(this._state)
            {
               case mx.video.VideoPlayer.SEEKING:
               case mx.video.VideoPlayer.REWINDING:
            }
            if(this._httpDoSeekIntervalID == 0)
            {
               this._httpDoSeekCount = 0;
               this._httpDoSeekIntervalID = setInterval(this,"httpDoSeek",mx.video.VideoPlayer.HTTP_DO_SEEK_INTERVAL);
            }
            break;
         case "NetStream.Play.StreamNotFound":
            this.setState(mx.video.VideoPlayer.CONNECTION_ERROR);
      }
   }
   function ncConnected()
   {
      if(this._ncMgr == null || this._ncMgr == undefined || this._ncMgr.getNetConnection() == null || this._ncMgr.getNetConnection() == undefined)
      {
         this.setState(mx.video.VideoPlayer.CONNECTION_ERROR);
      }
      else
      {
         this._createStream();
         this._setUpStream();
      }
   }
   function ncReconnected()
   {
      if(this._ncMgr == null || this._ncMgr == undefined || this._ncMgr.getNetConnection() == null || this._ncMgr.getNetConnection() == undefined)
      {
         this.setState(mx.video.VideoPlayer.CONNECTION_ERROR);
      }
      else
      {
         this._ns = null;
         this._state = mx.video.VideoPlayer.STOPPED;
         this.execQueuedCmds();
      }
   }
   function onMetaData(info)
   {
      if(this._metadata != null)
      {
         return undefined;
      }
      this._metadata = info;
      if(this._streamLength == undefined || this._streamLength == null || this._streamLength <= 0)
      {
         this._streamLength = info.duration;
      }
      if(isNaN(this._videoWidth) || this._videoWidth <= 0)
      {
         this._videoWidth = info.width;
      }
      if(isNaN(this._videoHeight) || this._videoHeight <= 0)
      {
         this._videoHeight = info.height;
      }
      this.dispatchEvent({type:"metadataReceived",info:info});
   }
   function onCuePoint(info)
   {
      if(!this._hiddenForResize)
      {
         this.dispatchEvent({type:"cuePoint",info:info});
      }
   }
   function setState(s)
   {
      if(s == this._state)
      {
         return undefined;
      }
      this._cachedState = this._state;
      this._cachedPlayheadTime = this.playheadTime;
      this._state = s;
      var _loc2_ = this._state;
      this.dispatchEvent({type:"stateChange",state:_loc2_,playheadTime:this.__get__playheadTime()});
      if(!this._readyDispatched)
      {
         switch(_loc2_)
         {
            case mx.video.VideoPlayer.STOPPED:
            case mx.video.VideoPlayer.PLAYING:
            case mx.video.VideoPlayer.PAUSED:
            case mx.video.VideoPlayer.BUFFERING:
         }
         this._readyDispatched = true;
         this.dispatchEvent({type:"ready",state:_loc2_,playheadTime:this.__get__playheadTime()});
      }
      if(this._cachedState === mx.video.VideoPlayer.REWINDING)
      {
         this.dispatchEvent({type:"rewind",state:_loc2_,playheadTime:this.__get__playheadTime()});
         if(this._ncMgr.isRTMP() && _loc2_ == mx.video.VideoPlayer.STOPPED)
         {
            this.closeNS();
         }
      }
      switch(_loc2_)
      {
         case mx.video.VideoPlayer.STOPPED:
         case mx.video.VideoPlayer.PAUSED:
            if(this._ncMgr.isRTMP() && this._idleTimeoutIntervalID == 0)
            {
               this._idleTimeoutIntervalID = setInterval(this,"doIdleTimeout",this._idleTimeoutInterval);
            }
            break;
         case mx.video.VideoPlayer.SEEKING:
         case mx.video.VideoPlayer.REWINDING:
            this._bufferState = mx.video.VideoPlayer.BUFFER_EMPTY;
         case mx.video.VideoPlayer.PLAYING:
         case mx.video.VideoPlayer.BUFFERING:
            if(this._updateTimeIntervalID == 0)
            {
               this._updateTimeIntervalID = setInterval(this,"doUpdateTime",this._updateTimeInterval);
            }
         case mx.video.VideoPlayer.LOADING:
         case mx.video.VideoPlayer.RESIZING:
            clearInterval(this._idleTimeoutIntervalID);
            this._idleTimeoutIntervalID = 0;
      }
      this.execQueuedCmds();
   }
   function setStateFromCachedState()
   {
      switch(this._cachedState)
      {
         case mx.video.VideoPlayer.PLAYING:
         case mx.video.VideoPlayer.PAUSED:
            this.setState(this._cachedState);
            break;
         case mx.video.VideoPlayer.BUFFERING:
            if(this._bufferState == mx.video.VideoPlayer.BUFFER_EMPTY)
            {
               this.setState(mx.video.VideoPlayer.BUFFERING);
            }
            else
            {
               this.setState(this._cachedState);
            }
            break;
         default:
            this.setState(mx.video.VideoPlayer.STOPPED);
      }
   }
   function createINCManager()
   {
      if(this.ncMgrClassName == null || this.ncMgrClassName == undefined)
      {
         this.ncMgrClassName = mx.video.VideoPlayer.DEFAULT_INCMANAGER;
      }
      var ncMgrConstructor = eval(this.ncMgrClassName);
      this._ncMgr = new ncMgrConstructor();
      this._ncMgr.setVideoPlayer(this);
   }
   function rtmpDoStopAtEnd(force)
   {
      if(this._rtmpDoStopAtEndIntervalID > 0)
      {
         switch(this._state)
         {
            case mx.video.VideoPlayer.DISCONNECTED:
            case mx.video.VideoPlayer.CONNECTION_ERROR:
               break;
            default:
               if(force || this._cachedPlayheadTime == this.__get__playheadTime())
               {
                  clearInterval(this._rtmpDoStopAtEndIntervalID);
                  this._rtmpDoStopAtEndIntervalID = 0;
               }
               else
               {
                  this._cachedPlayheadTime = this.playheadTime;
                  return undefined;
               }
         }
         clearInterval(this._rtmpDoStopAtEndIntervalID);
         this._rtmpDoStopAtEndIntervalID = 0;
         return undefined;
      }
      this._bufferState = mx.video.VideoPlayer.BUFFER_EMPTY;
      this._atEnd = true;
      this.setState(mx.video.VideoPlayer.STOPPED);
      if(this._state != mx.video.VideoPlayer.STOPPED)
      {
         return undefined;
      }
      this.doUpdateTime();
      if(this._state != mx.video.VideoPlayer.STOPPED)
      {
         return undefined;
      }
      this.dispatchEvent({type:"complete",state:this._state,playheadTime:this.__get__playheadTime()});
      if(this._state != mx.video.VideoPlayer.STOPPED)
      {
         return undefined;
      }
      if(this._autoRewind && !this._isLive && this.__get__playheadTime() != 0)
      {
         this._atEnd = false;
         this._currentPos = 0;
         this._play(0,0);
         this.setState(mx.video.VideoPlayer.REWINDING);
      }
      else
      {
         this.closeNS();
      }
   }
   function rtmpDoSeek()
   {
      if(this._state != mx.video.VideoPlayer.REWINDING && this._state != mx.video.VideoPlayer.SEEKING)
      {
         clearInterval(this._rtmpDoSeekIntervalID);
         this._rtmpDoSeekIntervalID = 0;
         this._sawSeekNotify = false;
      }
      else if(this.__get__playheadTime() != this._cachedPlayheadTime)
      {
         clearInterval(this._rtmpDoSeekIntervalID);
         this._rtmpDoSeekIntervalID = 0;
         this._sawSeekNotify = false;
         this.setStateFromCachedState();
         this.doUpdateTime();
      }
   }
   function httpDoStopAtEnd()
   {
      this._atEnd = true;
      if(this._streamLength == undefined || this._streamLength == null || this._streamLength <= 0)
      {
         this._streamLength = this._ns.time;
      }
      this._pause(true);
      this.setState(mx.video.VideoPlayer.STOPPED);
      if(this._state != mx.video.VideoPlayer.STOPPED)
      {
         return undefined;
      }
      this.doUpdateTime();
      if(this._state != mx.video.VideoPlayer.STOPPED)
      {
         return undefined;
      }
      this.dispatchEvent({type:"complete",state:this._state,playheadTime:this.__get__playheadTime()});
      if(this._state != mx.video.VideoPlayer.STOPPED)
      {
         return undefined;
      }
      if(this._autoRewind)
      {
         this._atEnd = false;
         this._pause(true);
         this._seek(0);
         this.setState(mx.video.VideoPlayer.REWINDING);
      }
   }
   function httpDoSeek()
   {
      var _loc2_ = this._state == mx.video.VideoPlayer.REWINDING || this._state == mx.video.VideoPlayer.SEEKING;
      if(_loc2_ && this._httpDoSeekCount < mx.video.VideoPlayer.HTTP_DO_SEEK_MAX_COUNT && this._cachedPlayheadTime == this.__get__playheadTime())
      {
         this._httpDoSeekCount = this._httpDoSeekCount + 1;
         return undefined;
      }
      this._httpDoSeekCount = 0;
      clearInterval(this._httpDoSeekIntervalID);
      this._httpDoSeekIntervalID = 0;
      if(!_loc2_)
      {
         return undefined;
      }
      this.setStateFromCachedState();
      this.doUpdateTime();
   }
   function closeNS(updateCurrentPos)
   {
      if(this._ns != null && this._ns != undefined)
      {
         if(updateCurrentPos)
         {
            clearInterval(this._updateTimeIntervalID);
            this._updateTimeIntervalID = 0;
            this.doUpdateTime();
            this._currentPos = this._ns.time;
         }
         delete this._ns.onStatus;
         this._ns.onStatus = null;
         this._ns.close();
         this._ns = null;
      }
   }
   function doDelayedBuffering()
   {
      switch(this._state)
      {
         case mx.video.VideoPlayer.LOADING:
         case mx.video.VideoPlayer.RESIZING:
            break;
         case mx.video.VideoPlayer.PLAYING:
            clearInterval(this._delayedBufferingIntervalID);
            this._delayedBufferingIntervalID = 0;
            this.setState(mx.video.VideoPlayer.BUFFERING);
            break;
         default:
            clearInterval(this._delayedBufferingIntervalID);
            this._delayedBufferingIntervalID = 0;
      }
   }
   function _pause(doPause)
   {
      this._ns.pause(doPause);
   }
   function _play()
   {
      this._startingPlay = true;
      switch(arguments.length)
      {
         case 0:
            this._ns.play(this._ncMgr.getStreamName(),!this._isLive?0:-1,-1);
            break;
         case 1:
            this._ns.play(this._ncMgr.getStreamName(),!this._isLive?arguments[0]:-1,-1);
            break;
         case 2:
            this._ns.play(this._ncMgr.getStreamName(),!this._isLive?arguments[0]:-1,arguments[1]);
            break;
         default:
            throw new Error("bad args to _play");
      }
   }
   function _seek(time)
   {
      if(this._metadata.audiodelay != undefined && time + this._metadata.audiodelay < this._streamLength)
      {
         time = time + this._metadata.audiodelay;
      }
      this._ns.seek(time);
      this._invalidSeekTime = false;
      this._bufferState = mx.video.VideoPlayer.BUFFER_EMPTY;
      this._sawSeekNotify = false;
   }
   function isXnOK()
   {
      if(this._state == mx.video.VideoPlayer.LOADING)
      {
         return true;
      }
      if(this._state == mx.video.VideoPlayer.CONNECTION_ERROR)
      {
         return false;
      }
      if(this._state != mx.video.VideoPlayer.DISCONNECTED)
      {
         if(this._ncMgr == null || this._ncMgr == undefined || this._ncMgr.getNetConnection() == null || this._ncMgr.getNetConnection() == undefined || !this._ncMgr.getNetConnection().isConnected)
         {
            this.setState(mx.video.VideoPlayer.DISCONNECTED);
            return false;
         }
         return true;
      }
      return false;
   }
   function startAutoResize()
   {
      switch(this._state)
      {
         case mx.video.VideoPlayer.DISCONNECTED:
         case mx.video.VideoPlayer.CONNECTION_ERROR:
            break;
         default:
            this._autoResizeDone = false;
            if(this.__get__stateResponsive() && this._videoWidth != undefined && this._videoHeight != undefined)
            {
               this.doAutoResize();
            }
            else
            {
               clearInterval(this._autoResizeIntervalID);
               this._autoResizeIntervalID = setInterval(this,"doAutoResize",mx.video.VideoPlayer.AUTO_RESIZE_INTERVAL);
            }
      }
      return undefined;
   }
   function doAutoResize()
   {
      if(this._autoResizeIntervalID > 0)
      {
         switch(this._state)
         {
            case mx.video.VideoPlayer.RESIZING:
            case mx.video.VideoPlayer.LOADING:
               if(this._video.width != this._prevVideoWidth || this._video.height != this._prevVideoHeight || this._bufferState >= mx.video.VideoPlayer.BUFFER_FULL || this._ns.time > mx.video.VideoPlayer.AUTO_RESIZE_PLAYHEAD_TIMEOUT)
               {
                  if(this._hiddenForResize && this._metadata == null && this._hiddenForResizeMetadataDelay < mx.video.VideoPlayer.AUTO_RESIZE_METADATA_DELAY_MAX)
                  {
                     this._hiddenForResizeMetadataDelay = this._hiddenForResizeMetadataDelay + 1;
                     return undefined;
                  }
                  this._videoWidth = this._video.width;
                  this._videoHeight = this._video.height;
                  clearInterval(this._autoResizeIntervalID);
                  this._autoResizeIntervalID = 0;
               }
               else
               {
                  return undefined;
               }
            case mx.video.VideoPlayer.DISCONNECTED:
            case mx.video.VideoPlayer.CONNECTION_ERROR:
               clearInterval(this._autoResizeIntervalID);
               this._autoResizeIntervalID = 0;
               return undefined;
            default:
               if(!this.__get__stateResponsive())
               {
                  return undefined;
               }
               if(this._video.width != this._prevVideoWidth || this._video.height != this._prevVideoHeight || this._bufferState >= mx.video.VideoPlayer.BUFFER_FULL || this._ns.time > mx.video.VideoPlayer.AUTO_RESIZE_PLAYHEAD_TIMEOUT)
               {
                  if(this._hiddenForResize && this._metadata == null && this._hiddenForResizeMetadataDelay < mx.video.VideoPlayer.AUTO_RESIZE_METADATA_DELAY_MAX)
                  {
                     this._hiddenForResizeMetadataDelay = this._hiddenForResizeMetadataDelay + 1;
                     return undefined;
                  }
                  this._videoWidth = this._video.width;
                  this._videoHeight = this._video.height;
                  clearInterval(this._autoResizeIntervalID);
                  this._autoResizeIntervalID = 0;
               }
               else
               {
                  return undefined;
               }
         }
      }
      if(!this._autoSize && !this._aspectRatio || this._autoResizeDone)
      {
         this.setState(this._cachedState);
         return undefined;
      }
      this._autoResizeDone = true;
      if(this._autoSize)
      {
         this._video._width = this._videoWidth;
         this._video._height = this._videoHeight;
      }
      else if(this._aspectRatio)
      {
         var _loc3_ = this._videoWidth * this.__get__height() / this._videoHeight;
         var _loc2_ = this._videoHeight * this.__get__width() / this._videoWidth;
         if(_loc2_ < this.__get__height())
         {
            this._video._height = _loc2_;
         }
         else if(_loc3_ < this.__get__width())
         {
            this._video._width = _loc3_;
         }
      }
      if(this._hiddenForResize)
      {
         if(this._state == mx.video.VideoPlayer.LOADING)
         {
            this._cachedState = mx.video.VideoPlayer.PLAYING;
         }
         if(!this._ncMgr.isRTMP())
         {
            this._pause(true);
            this._seek(0);
            clearInterval(this._finishAutoResizeIntervalID);
            this._finishAutoResizeIntervalID = setInterval(this,"finishAutoResize",mx.video.VideoPlayer.FINISH_AUTO_RESIZE_INTERVAL);
         }
         else if(!this._isLive)
         {
            this._currentPos = 0;
            this._play(0,0);
            this.setState(mx.video.VideoPlayer.RESIZING);
         }
         else if(this._autoPlay)
         {
            clearInterval(this._finishAutoResizeIntervalID);
            this._finishAutoResizeIntervalID = setInterval(this,"finishAutoResize",mx.video.VideoPlayer.FINISH_AUTO_RESIZE_INTERVAL);
         }
         else
         {
            this.finishAutoResize();
         }
      }
      else
      {
         this.dispatchEvent({type:"resize",x:this._x,y:this._y,width:this._width,height:this._height});
      }
   }
   function finishAutoResize()
   {
      clearInterval(this._finishAutoResizeIntervalID);
      this._finishAutoResizeIntervalID = 0;
      if(this.__get__stateResponsive())
      {
         return undefined;
      }
      this._visible = this.__visible;
      this._sound.setVolume(this._volume);
      this._hiddenForResize = false;
      this.dispatchEvent({type:"resize",x:this._x,y:this._y,width:this._width,height:this._height});
      if(this._autoPlay)
      {
         if(this._ncMgr.isRTMP())
         {
            if(!this._isLive)
            {
               this._currentPos = 0;
               this._play(0);
            }
            if(this._state == mx.video.VideoPlayer.RESIZING)
            {
               this.setState(mx.video.VideoPlayer.LOADING);
               this._cachedState = mx.video.VideoPlayer.PLAYING;
            }
         }
         else
         {
            this._pause(false);
            this._cachedState = mx.video.VideoPlayer.PLAYING;
         }
      }
      else
      {
         this.setState(mx.video.VideoPlayer.STOPPED);
      }
   }
   function _createStream()
   {
      this._ns = new NetStream(this._ncMgr.getNetConnection());
      this._ns.mc = this;
      if(this._ncMgr.isRTMP())
      {
         this._ns.onStatus = function(info)
         {
            this.mc.rtmpOnStatus(info);
         };
      }
      else
      {
         this._ns.onStatus = function(info)
         {
            this.mc.httpOnStatus(info);
         };
      }
      this._ns.onMetaData = function(info)
      {
         this.mc.onMetaData(info);
      };
      this._ns.onCuePoint = function(info)
      {
         this.mc.onCuePoint(info);
      };
      this._ns.setBufferTime(this._bufferTime);
   }
   function _setUpStream()
   {
      this._video.attachVideo(this._ns);
      this.attachAudio(this._ns);
      if(!isNaN(this._ncMgr.getStreamLength()) && this._ncMgr.getStreamLength() >= 0)
      {
         this._streamLength = this._ncMgr.getStreamLength();
      }
      if(!isNaN(this._ncMgr.getStreamWidth()) && this._ncMgr.getStreamWidth() >= 0)
      {
         this._videoWidth = this._ncMgr.getStreamWidth();
      }
      else
      {
         this._videoWidth = undefined;
      }
      if(!isNaN(this._ncMgr.getStreamHeight()) && this._ncMgr.getStreamHeight() >= 0)
      {
         this._videoHeight = this._ncMgr.getStreamHeight();
      }
      else
      {
         this._videoHeight = undefined;
      }
      if((this._autoSize || this._aspectRatio) && this._videoWidth != undefined && this._videoHeight != undefined)
      {
         this._prevVideoWidth = undefined;
         this._prevVideoHeight = undefined;
         this.doAutoResize();
      }
      if(!this._autoSize && !this._aspectRatio || this._videoWidth != undefined && this._videoHeight != undefined)
      {
         if(this._autoPlay)
         {
            if(!this._ncMgr.isRTMP())
            {
               this._cachedState = mx.video.VideoPlayer.BUFFERING;
               this._play();
            }
            else if(this._isLive)
            {
               this._cachedState = mx.video.VideoPlayer.BUFFERING;
               this._play(-1);
            }
            else
            {
               this._cachedState = mx.video.VideoPlayer.BUFFERING;
               this._play(0);
            }
         }
         else
         {
            this._cachedState = mx.video.VideoPlayer.STOPPED;
            if(this._ncMgr.isRTMP())
            {
               this._play(0,0);
            }
            else
            {
               this._play();
               this._pause(true);
               this._seek(0);
            }
         }
      }
      else
      {
         this._hiddenForResize = true;
         this._hiddenForResizeMetadataDelay = 0;
         this.__visible = this._visible;
         this._visible = false;
         this._volume = this._sound.getVolume();
         this._sound.setVolume(0);
         this._play(0);
         if(this._currentPos > 0)
         {
            this._seek(this._currentPos);
            this._currentPos = 0;
         }
      }
      clearInterval(this._autoResizeIntervalID);
      this._autoResizeIntervalID = setInterval(this,"doAutoResize",mx.video.VideoPlayer.AUTO_RESIZE_INTERVAL);
   }
   function doIdleTimeout()
   {
      clearInterval(this._idleTimeoutIntervalID);
      this._idleTimeoutIntervalID = 0;
      this.close();
   }
   function flushQueuedCmds()
   {
      while(this._cmdQueue.length > 0)
      {
         this._cmdQueue.pop();
      }
   }
   function execQueuedCmds()
   {
      while(this._cmdQueue.length > 0 && (this.__get__stateResponsive() || this._state == mx.video.VideoPlayer.CONNECTION_ERROR) && (this._cmdQueue[0].url != null && this._cmdQueue[0].url != undefined || this._state != mx.video.VideoPlayer.DISCONNECTED && this._state != mx.video.VideoPlayer.CONNECTION_ERROR))
      {
         var _loc2_ = this._cmdQueue.shift();
         this._cachedState = this._state;
         this._state = mx.video.VideoPlayer.EXEC_QUEUED_CMD;
         switch(_loc2_.type)
         {
            case mx.video.VideoPlayer.PLAY:
               this.play(_loc2_.url,_loc2_.isLive,_loc2_.time);
               break;
            case mx.video.VideoPlayer.LOAD:
               this.load(_loc2_.url,_loc2_.isLive,_loc2_.time);
               break;
            case mx.video.VideoPlayer.PAUSE:
               this.pause();
               break;
            case mx.video.VideoPlayer.STOP:
               this.stop();
               break;
            case mx.video.VideoPlayer.SEEK:
               this.seek(_loc2_.time);
         }
      }
   }
   function queueCmd(type, url, isLive, time)
   {
      this._cmdQueue.push({type:type,url:url,isLive:false,time:time});
   }
}
