class mx.video.SMILManager
{
   static var version = "1.0.0.94";
   static var ELEMENT_NODE = 1;
   function SMILManager(owner)
   {
      this._owner = owner;
   }
   function connectXML(url)
   {
      this._url = url;
      this.xml = new XML();
      this.xml.onLoad = mx.utils.Delegate.create(this,this.xmlOnLoad);
      this.xml.load(url);
      return false;
   }
   function xmlOnLoad(success)
   {
      try
      {
         if(!success)
         {
            this._owner.helperDone(this,false);
         }
         else
         {
            this.baseURLAttr = new Array();
            this.videoTags = new Array();
            var _loc4_ = this.xml.firstChild;
            if(_loc4_.nodeName == null)
            {
               throw new mx.video.VideoError(mx.video.VideoError.INVALID_XML,"URL: \"" + this._url + "\" No root node found; if file is an flv it must have .flv extension");
            }
            else if(_loc4_.nodeName.toLowerCase() != "smil")
            {
               throw new mx.video.VideoError(mx.video.VideoError.INVALID_XML,"URL: \"" + this._url + "\" Root node not smil: " + _loc4_.nodeName);
            }
            else
            {
               var _loc5_ = false;
               var _loc3_ = 0;
               while(_loc3_ < _loc4_.childNodes.length)
               {
                  var _loc2_ = _loc4_.childNodes[_loc3_];
                  if(_loc2_.nodeType == mx.video.SMILManager.ELEMENT_NODE)
                  {
                     if(_loc2_.nodeName.toLowerCase() == "head")
                     {
                        this.parseHead(_loc2_);
                     }
                     else if(_loc2_.nodeName.toLowerCase() == "body")
                     {
                        _loc5_ = true;
                        this.parseBody(_loc2_);
                     }
                     else
                     {
                        throw new mx.video.VideoError(mx.video.VideoError.INVALID_XML,"URL: \"" + this._url + "\" Tag " + _loc2_.nodeName + " not supported in " + _loc4_.nodeName + " tag.");
                     }
                  }
                  _loc3_ = _loc3_ + 1;
               }
               if(!_loc5_)
               {
                  throw new mx.video.VideoError(mx.video.VideoError.INVALID_XML,"URL: \"" + this._url + "\" Tag body is required.");
               }
               else
               {
                  this._owner.helperDone(this,true);
               }
            }
         }
      }
      catch(register0)
      {
         §§push((Error)_loc0_);
         if((Error)_loc0_ != null)
         {
            var err = §§pop();
            this._owner.helperDone(this,false);
            throw err;
         }
         else
         {
            §§pop();
            throw _loc0_;
         }
      }
   }
   function parseHead(parentNode)
   {
      var _loc4_ = false;
      var _loc3_ = 0;
      while(_loc3_ < parentNode.childNodes.length)
      {
         var _loc2_ = parentNode.childNodes[_loc3_];
         if(_loc2_.nodeType == mx.video.SMILManager.ELEMENT_NODE)
         {
            if(_loc2_.nodeName.toLowerCase() == "meta")
            {
               for(var _loc6_ in _loc2_.attributes)
               {
                  if(_loc6_.toLowerCase() == "base")
                  {
                     this.baseURLAttr.push(_loc2_.attributes[_loc6_]);
                     continue;
                  }
                  throw new mx.video.VideoError(mx.video.VideoError.INVALID_XML,"URL: \"" + this._url + "\" Attribute " + _loc6_ + " not supported in " + _loc2_.nodeName + " tag.");
               }
            }
            else if(_loc2_.nodeName.toLowerCase() == "layout")
            {
               if(!_loc4_)
               {
                  this.parseLayout(_loc2_);
                  _loc4_ = true;
               }
            }
         }
         _loc3_ = _loc3_ + 1;
      }
   }
   function parseLayout(parentNode)
   {
      var _loc3_ = 0;
      while(_loc3_ < parentNode.childNodes.length)
      {
         var _loc2_ = parentNode.childNodes[_loc3_];
         if(_loc2_.nodeType == mx.video.SMILManager.ELEMENT_NODE)
         {
            if(_loc2_.nodeName.toLowerCase() == "root-layout")
            {
               for(var _loc5_ in _loc2_.attributes)
               {
                  if(_loc5_.toLowerCase() == "width")
                  {
                     this.width = Number(_loc2_.attributes[_loc5_]);
                  }
                  else if(_loc5_.toLowerCase() == "height")
                  {
                     this.height = Number(_loc2_.attributes[_loc5_]);
                  }
               }
               if(isNaN(this.width) || this.width < 0 || isNaN(this.height) || this.height < 0)
               {
                  throw new mx.video.VideoError(mx.video.VideoError.INVALID_XML,"URL: \"" + this._url + "\" Tag " + _loc2_.nodeName + " requires attributes id, width and height.  Width and height must be numbers greater than or equal to 0.");
               }
               else
               {
                  this.width = Math.round(this.width);
                  this.height = Math.round(this.height);
                  return undefined;
               }
            }
         }
         _loc3_ = _loc3_ + 1;
      }
   }
   function parseBody(parentNode)
   {
      var _loc6_ = 0;
      var _loc3_ = 0;
      while(_loc3_ < parentNode.childNodes.length)
      {
         var _loc2_ = parentNode.childNodes[_loc3_];
         if(_loc2_.nodeType == mx.video.SMILManager.ELEMENT_NODE)
         {
            if((_loc6_ = _loc6_ + 1) > 1)
            {
               throw new mx.video.VideoError(mx.video.VideoError.INVALID_XML,"URL: \"" + this._url + "\" Tag " + parentNode.nodeName + " is required to contain exactly one tag.");
            }
            else if(_loc2_.nodeName.toLowerCase() == "switch")
            {
               this.parseSwitch(_loc2_);
            }
            else if(_loc2_.nodeName.toLowerCase() == "video" || _loc2_.nodeName.toLowerCase() == "ref")
            {
               var _loc5_ = this.parseVideo(_loc2_);
               this.videoTags.push(_loc5_);
            }
         }
         _loc3_ = _loc3_ + 1;
      }
      if(this.videoTags.length < 1)
      {
         throw new mx.video.VideoError(mx.video.VideoError.INVALID_XML,"URL: \"" + this._url + "\" At least one video of ref tag is required.");
      }
   }
   function parseSwitch(parentNode)
   {
      var _loc4_ = 0;
      while(_loc4_ < parentNode.childNodes.length)
      {
         var _loc5_ = parentNode.childNodes[_loc4_];
         if(_loc5_.nodeType == mx.video.SMILManager.ELEMENT_NODE)
         {
            if(_loc5_.nodeName.toLowerCase() == "video" || _loc5_.nodeName.toLowerCase() == "ref")
            {
               var _loc3_ = this.parseVideo(_loc5_);
               if(_loc3_.bitrate == undefined)
               {
                  this.videoTags.push(_loc3_);
               }
               else
               {
                  var _loc6_ = false;
                  var _loc2_ = 0;
                  while(_loc2_ < this.videoTags.length)
                  {
                     if(this.videoTags[_loc2_].bitrate == undefined || _loc3_.bitrate < this.videoTags[_loc4_].bitrate)
                     {
                        _loc6_ = true;
                        this.videoTags.splice(_loc2_,0,this.videoTags);
                        break;
                     }
                     _loc2_ = _loc2_ + 1;
                  }
                  if(!_loc6_)
                  {
                     this.videoTags.push(_loc3_);
                  }
               }
            }
         }
         _loc4_ = _loc4_ + 1;
      }
   }
   function parseVideo(node)
   {
      var _loc3_ = new Object();
      for(var _loc4_ in node.attributes)
      {
         if(_loc4_.toLowerCase() == "src")
         {
            _loc3_.src = node.attributes[_loc4_];
         }
         else if(_loc4_.toLowerCase() == "system-bitrate")
         {
            _loc3_.bitrate = Number(node.attributes[_loc4_]);
         }
         else if(_loc4_.toLowerCase() == "dur")
         {
            _loc3_.dur = Number(node.attributes[_loc4_]);
         }
      }
      if(_loc3_.src == undefined)
      {
         throw new mx.video.VideoError(mx.video.VideoError.INVALID_XML,"URL: \"" + this._url + "\" Attribute src is required in " + node.nodeName + " tag.");
      }
      else
      {
         return _loc3_;
      }
   }
}
