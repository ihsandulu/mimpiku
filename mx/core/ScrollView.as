if(!_global.mx)
{
   _global.mx = new Object();
}
§§pop();
if(!_global.mx.core)
{
   _global.mx.core = new Object();
}
§§pop();
if(!mx.core.ScrollView)
{
   mx.core.ScrollView.prototype = new mx.core.View().getHScrollPolicy = function(Void)
   {
      return this.__hScrollPolicy;
   };
   mx.core.ScrollView.prototype = new mx.core.View().setHScrollPolicy = function(policy)
   {
      this.__hScrollPolicy = policy.toLowerCase();
      if(this.__width == undefined)
      {
         return undefined;
      }
      this.setScrollProperties(this.numberOfCols,this.columnWidth,this.rowC,this.rowH,this.heightPadding,this.widthPadding);
   };
   mx.core.ScrollView.prototype = new mx.core.View().__get__hScrollPolicy = function()
   {
      return this.getHScrollPolicy();
   };
   mx.core.ScrollView.prototype = new mx.core.View().__set__hScrollPolicy = function(policy)
   {
      this.setHScrollPolicy(policy);
      return this.__get__hScrollPolicy();
   };
   mx.core.ScrollView.prototype = new mx.core.View().getVScrollPolicy = function(Void)
   {
      return this.__vScrollPolicy;
   };
   mx.core.ScrollView.prototype = new mx.core.View().setVScrollPolicy = function(policy)
   {
      this.__vScrollPolicy = policy.toLowerCase();
      if(this.__width == undefined)
      {
         return undefined;
      }
      this.setScrollProperties(this.numberOfCols,this.columnWidth,this.rowC,this.rowH,this.heightPadding,this.widthPadding);
   };
   mx.core.ScrollView.prototype = new mx.core.View().__get__vScrollPolicy = function()
   {
      return this.getVScrollPolicy();
   };
   mx.core.ScrollView.prototype = new mx.core.View().__set__vScrollPolicy = function(policy)
   {
      this.setVScrollPolicy(policy);
      return this.__get__vScrollPolicy();
   };
   mx.core.ScrollView.prototype = new mx.core.View().__get__hPosition = function()
   {
      return this.getHPosition();
   };
   mx.core.ScrollView.prototype = new mx.core.View().__set__hPosition = function(pos)
   {
      this.setHPosition(pos);
      return this.__get__hPosition();
   };
   mx.core.ScrollView.prototype = new mx.core.View().getHPosition = function(Void)
   {
      return this.__hPosition;
   };
   mx.core.ScrollView.prototype = new mx.core.View().setHPosition = function(pos)
   {
      this.hScroller.__set__scrollPosition(pos);
      this.__hPosition = pos;
   };
   mx.core.ScrollView.prototype = new mx.core.View().__get__vPosition = function()
   {
      return this.getVPosition();
   };
   mx.core.ScrollView.prototype = new mx.core.View().__set__vPosition = function(pos)
   {
      this.setVPosition(pos);
      return this.__get__vPosition();
   };
   mx.core.ScrollView.prototype = new mx.core.View().getVPosition = function(Void)
   {
      return this.__vPosition;
   };
   mx.core.ScrollView.prototype = new mx.core.View().setVPosition = function(pos)
   {
      this.vScroller.__set__scrollPosition(pos);
      this.__vPosition = pos;
   };
   mx.core.ScrollView.prototype = new mx.core.View().__get__maxVPosition = function()
   {
      var _loc2_ = this.vScroller.maxPos;
      return _loc2_ != undefined?_loc2_:0;
   };
   mx.core.ScrollView.prototype = new mx.core.View().__get__maxHPosition = function()
   {
      return this.getMaxHPosition();
   };
   mx.core.ScrollView.prototype = new mx.core.View().__set__maxHPosition = function(pos)
   {
      this.setMaxHPosition(pos);
      return this.__get__maxHPosition();
   };
   mx.core.ScrollView.prototype = new mx.core.View().getMaxHPosition = function(Void)
   {
      if(this.__maxHPosition != undefined)
      {
         return this.__maxHPosition;
      }
      var _loc2_ = this.hScroller.maxPos;
      return _loc2_ != undefined?_loc2_:0;
   };
   mx.core.ScrollView.prototype = new mx.core.View().setMaxHPosition = function(pos)
   {
      this.__maxHPosition = pos;
   };
   mx.core.ScrollView.prototype = new mx.core.View().setScrollProperties = function(colCount, colWidth, rwCount, rwHeight, hPadding, wPadding)
   {
      var _loc3_ = this.getViewMetrics();
      if(hPadding == undefined)
      {
         hPadding = 0;
      }
      if(wPadding == undefined)
      {
         wPadding = 0;
      }
      this.propsInited = true;
      delete this.scrollAreaChanged;
      this.heightPadding = hPadding;
      this.widthPadding = wPadding;
      if(colWidth == 0)
      {
         colWidth = 1;
      }
      if(rwHeight == 0)
      {
         rwHeight = 1;
      }
      var _loc5_ = Math.ceil((this.__width - _loc3_.left - _loc3_.right - this.widthPadding) / colWidth);
      if(this.__hScrollPolicy == "on" || _loc5_ < colCount && this.__hScrollPolicy == "auto")
      {
         if(this.hScroller == undefined || this.specialHScrollCase)
         {
            delete this.specialHScrollCase;
            this.hScroller = this.createObject("HScrollBar","hSB",1001);
            this.hScroller.__set__lineScrollSize(20);
            this.hScroller.scrollHandler = this.scrollProxy;
            this.hScroller.__set__scrollPosition(this.__hPosition);
            this.scrollAreaChanged = true;
         }
         if(this.numberOfCols != colCount || this.columnWidth != colWidth || this.viewableColumns != _loc5_ || this.scrollAreaChanged)
         {
            this.hScroller.setScrollProperties(_loc5_,0,colCount - _loc5_);
            this.viewableColumns = _loc5_;
            this.numberOfCols = colCount;
            this.columnWidth = colWidth;
         }
      }
      else if((this.__hScrollPolicy == "auto" || this.__hScrollPolicy == "off") && this.hScroller != undefined)
      {
         this.hScroller.removeMovieClip();
         delete this.hScroller;
         this.scrollAreaChanged = true;
      }
      if(this.heightPadding == undefined)
      {
         this.heightPadding = 0;
      }
      var _loc4_ = Math.ceil((this.__height - _loc3_.top - _loc3_.bottom - this.heightPadding) / rwHeight);
      var _loc8_ = (this.__height - _loc3_.top - _loc3_.bottom) % rwHeight != 0;
      if(this.__vScrollPolicy == "on" || _loc4_ < rwCount + _loc8_ && this.__vScrollPolicy == "auto")
      {
         if(this.vScroller == undefined)
         {
            this.vScroller = this.createObject("VScrollBar","vSB",1002);
            this.vScroller.scrollHandler = this.scrollProxy;
            this.vScroller.__set__scrollPosition(this.__vPosition);
            this.scrollAreaChanged = true;
            this.rowH = 0;
         }
         if(this.rowC != rwCount || this.rowH != rwHeight || this.viewableRows + _loc8_ != _loc4_ + this.oldRndUp || this.scrollAreaChanged)
         {
            this.vScroller.setScrollProperties(_loc4_,0,rwCount - _loc4_ + _loc8_);
            this.viewableRows = _loc4_;
            this.rowC = rwCount;
            this.rowH = rwHeight;
            this.oldRndUp = _loc8_;
         }
      }
      else if((this.__vScrollPolicy == "auto" || this.__vScrollPolicy == "off") && this.vScroller != undefined)
      {
         this.vScroller.removeMovieClip();
         delete this.vScroller;
         this.scrollAreaChanged = true;
      }
      this.numberOfCols = colCount;
      this.columnWidth = colWidth;
      if(this.scrollAreaChanged)
      {
         this.doLayout();
         var _loc2_ = this.__viewMetrics;
         var _loc12_ = this.owner == undefined?this:this.owner;
         _loc12_.layoutContent(_loc2_.left,_loc2_.top,this.columnWidth * this.numberOfCols - _loc2_.left - _loc2_.right,this.rowC * this.rowH,this.__width - _loc2_.left - _loc2_.right,this.__height - _loc2_.top - _loc2_.bottom);
      }
      if(!this.enabled)
      {
         this.setEnabled(false);
      }
   };
   mx.core.ScrollView.prototype = new mx.core.View().getViewMetrics = function(Void)
   {
      var _loc2_ = this.__viewMetrics;
      var _loc3_ = this.border_mc.__get__borderMetrics();
      _loc2_.left = _loc3_.left;
      _loc2_.right = _loc3_.right;
      if(this.vScroller != undefined)
      {
         _loc2_.right = _loc2_.right + this.vScroller.minWidth;
      }
      _loc2_.top = _loc3_.top;
      if(this.hScroller == undefined && (this.__hScrollPolicy == "on" || this.__hScrollPolicy == true))
      {
         this.hScroller = this.createObject("FHScrollBar","hSB",1001);
         this.specialHScrollCase = true;
      }
      _loc2_.bottom = _loc3_.bottom;
      if(this.hScroller != undefined)
      {
         _loc2_.bottom = _loc2_.bottom + this.hScroller.minHeight;
      }
      return _loc2_;
   };
   mx.core.ScrollView.prototype = new mx.core.View().doLayout = function(Void)
   {
      var _loc10_ = this.__get__width();
      var _loc8_ = this.__get__height();
      delete this.invLayout;
      var _loc3_ = this.__viewMetrics = this.getViewMetrics();
      var _loc2_ = this.__viewMetrics = this.getViewMetrics().left;
      var _loc9_ = this.__viewMetrics = this.getViewMetrics().right;
      var _loc5_ = this.__viewMetrics = this.getViewMetrics().top;
      var _loc11_ = this.__viewMetrics = this.getViewMetrics().bottom;
      var _loc7_ = this.hScroller;
      var _loc6_ = this.vScroller;
      _loc7_.setSize(_loc10_ - _loc2_ - _loc9_,_loc7_.minHeight + 0);
      _loc7_.move(_loc2_,_loc8_ - _loc11_);
      _loc6_.setSize(_loc6_.minWidth + 0,_loc8_ - _loc5_ - _loc11_);
      _loc6_.move(_loc10_ - _loc9_,_loc5_);
      var _loc4_ = this.mask_mc;
      _loc4_._width = _loc10_ - _loc2_ - _loc9_;
      _loc4_._height = _loc8_ - _loc5_ - _loc11_;
      _loc4_._x = _loc2_;
      _loc4_._y = _loc5_;
   };
   mx.core.ScrollView.prototype = new mx.core.View().createChild = function(id, name, props)
   {
      var _loc2_ = super.createChild(id,name,props);
      return _loc2_;
   };
   mx.core.ScrollView.prototype = new mx.core.View().init = function(Void)
   {
      super.init();
      this.__viewMetrics = new Object();
      if(_global.__SVMouseWheelManager == undefined)
      {
         var _loc4_ = _global.__SVMouseWheelManager = new Object();
         _global.__SVMouseWheelManager = new Object().onMouseWheel = this.__onMouseWheel;
         Mouse.addListener(_global.__SVMouseWheelManager = new Object());
      }
   };
   mx.core.ScrollView.prototype = new mx.core.View().__onMouseWheel = function(delta, scrollTarget)
   {
      var _loc4_ = scrollTarget;
      var _loc1_ = undefined;
      while(_loc4_ != undefined)
      {
         if(_loc4_ instanceof mx.core.ScrollView)
         {
            _loc1_ = _loc4_;
            false;
         }
         _loc4_ = _loc4_._parent;
      }
      if(_loc1_ != undefined)
      {
         _loc4_ = delta > 0?-1:1;
         var _loc2_ = _loc1_.vScroller.lineScrollSize;
         if(_loc2_ == undefined)
         {
            _loc2_ = 0;
         }
         _loc2_ = Math.max(Math.abs(delta),_loc2_);
         var _loc3_ = _loc1_.vPosition + _loc2_ * _loc4_;
         _loc1_.vPosition = Math.max(0,Math.min(_loc3_,_loc1_.maxVPosition));
         _loc1_.dispatchEvent({type:"scroll",direction:"vertical",position:_loc1_.vPosition});
      }
   };
   mx.core.ScrollView.prototype = new mx.core.View().createChildren = function(Void)
   {
      super.createChildren();
      if(this.mask_mc == undefined)
      {
         this.mask_mc = this.createObject("BoundingBox","mask_mc",this.MASK_DEPTH);
      }
      this.mask_mc._visible = false;
   };
   mx.core.ScrollView.prototype = new mx.core.View().invalidate = function(Void)
   {
      super.invalidate();
   };
   mx.core.ScrollView.prototype = new mx.core.View().draw = function(Void)
   {
      this.size();
   };
   mx.core.ScrollView.prototype = new mx.core.View().size = function(Void)
   {
      super.size();
   };
   mx.core.ScrollView.prototype = new mx.core.View().scrollProxy = function(docObj)
   {
      this._parent.onScroll(docObj);
   };
   mx.core.ScrollView.prototype = new mx.core.View().onScroll = function(docObj)
   {
      var _loc3_ = docObj.target;
      var _loc2_ = _loc3_.scrollPosition;
      if(_loc3_ == this.vScroller)
      {
         var _loc4_ = "vertical";
         var _loc5_ = "__vPosition";
      }
      else
      {
         _loc4_ = "horizontal";
         _loc5_ = "__hPosition";
      }
      this[_loc5_] = _loc2_;
      this.dispatchEvent({type:"scroll",direction:_loc4_,position:_loc2_});
   };
   mx.core.ScrollView.prototype = new mx.core.View().setEnabled = function(v)
   {
      this.vScroller.enabled = this.hScroller.enabled = v;
   };
   mx.core.ScrollView.prototype = new mx.core.View().childLoaded = function(obj)
   {
      super.childLoaded(obj);
      obj.setMask(this.mask_mc);
   };
   mx.core.ScrollView = function()
   {
      super();
   }.symbolName = "ScrollView";
   mx.core.ScrollView = function()
   {
      super();
   }.symbolOwner = mx.core.ScrollView;
   mx.core.ScrollView = function()
   {
      super();
   }.version = "2.0.2.123";
   mx.core.ScrollView.prototype = new mx.core.View().className = "ScrollView";
   mx.core.ScrollView.prototype = new mx.core.View().__vScrollPolicy = "auto";
   mx.core.ScrollView.prototype = new mx.core.View().__hScrollPolicy = "off";
   mx.core.ScrollView.prototype = new mx.core.View().__vPosition = 0;
   mx.core.ScrollView.prototype = new mx.core.View().__hPosition = 0;
   mx.core.ScrollView.prototype = new mx.core.View().numberOfCols = 0;
   mx.core.ScrollView.prototype = new mx.core.View().rowC = 0;
   mx.core.ScrollView.prototype = new mx.core.View().columnWidth = 1;
   mx.core.ScrollView.prototype = new mx.core.View().rowH = 0;
   mx.core.ScrollView.prototype = new mx.core.View().heightPadding = 0;
   mx.core.ScrollView.prototype = new mx.core.View().widthPadding = 0;
   mx.core.ScrollView.prototype = new mx.core.View().MASK_DEPTH = 10000;
   §§push((mx.core.ScrollView.prototype = new mx.core.View()).addProperty("hPosition",mx.core.ScrollView.prototype = new mx.core.View().__get__hPosition,mx.core.ScrollView.prototype = new mx.core.View().__set__hPosition));
   §§push((mx.core.ScrollView.prototype = new mx.core.View()).addProperty("hScrollPolicy",mx.core.ScrollView.prototype = new mx.core.View().__get__hScrollPolicy,mx.core.ScrollView.prototype = new mx.core.View().__set__hScrollPolicy));
   §§push((mx.core.ScrollView.prototype = new mx.core.View()).addProperty("maxHPosition",mx.core.ScrollView.prototype = new mx.core.View().__get__maxHPosition,mx.core.ScrollView.prototype = new mx.core.View().__set__maxHPosition));
   §§push((mx.core.ScrollView.prototype = new mx.core.View()).addProperty("maxVPosition",mx.core.ScrollView.prototype = new mx.core.View().__get__maxVPosition,function()
   {
   }
   ));
   §§push((mx.core.ScrollView.prototype = new mx.core.View()).addProperty("vPosition",mx.core.ScrollView.prototype = new mx.core.View().__get__vPosition,mx.core.ScrollView.prototype = new mx.core.View().__set__vPosition));
   §§push((mx.core.ScrollView.prototype = new mx.core.View()).addProperty("vScrollPolicy",mx.core.ScrollView.prototype = new mx.core.View().__get__vScrollPolicy,mx.core.ScrollView.prototype = new mx.core.View().__set__vScrollPolicy));
   §§push(ASSetPropFlags(mx.core.ScrollView.prototype,null,1));
}
§§pop();
