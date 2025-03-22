if(!_global.mx)
{
   _global.mx = new Object();
}
§§pop();
if(!_global.mx.controls)
{
   _global.mx.controls = new Object();
}
§§pop();
if(!_global.mx.controls.scrollClasses)
{
   _global.mx.controls.scrollClasses = new Object();
}
§§pop();
if(!mx.controls.scrollClasses.ScrollThumb)
{
   mx.controls.scrollClasses.ScrollThumb.prototype = new mx.skins.CustomBorder().createChildren = function(Void)
   {
      super.createChildren();
      this.useHandCursor = false;
   };
   mx.controls.scrollClasses.ScrollThumb.prototype = new mx.skins.CustomBorder().setRange = function(_ymin, _ymax, _datamin, _datamax)
   {
      this.ymin = _ymin;
      this.ymax = _ymax;
      this.datamin = _datamin;
      this.datamax = _datamax;
   };
   mx.controls.scrollClasses.ScrollThumb.prototype = new mx.skins.CustomBorder().dragThumb = function(Void)
   {
      this.scrollMove = this._ymouse - this.lastY;
      this.scrollMove = this.scrollMove + this._y;
      if(this.scrollMove < this.ymin)
      {
         this.scrollMove = this.ymin;
      }
      else if(this.scrollMove > this.ymax)
      {
         this.scrollMove = this.ymax;
      }
      this._parent.isScrolling = true;
      this._y = this.scrollMove;
      var _loc2_ = Math.round((this.datamax - this.datamin) * (this._y - this.ymin) / (this.ymax - this.ymin)) + this.datamin;
      this._parent.scrollPosition = _loc2_;
      this._parent.dispatchScrollEvent("ThumbTrack");
      updateAfterEvent();
   };
   mx.controls.scrollClasses.ScrollThumb.prototype = new mx.skins.CustomBorder().stopDragThumb = function(Void)
   {
      this._parent.isScrolling = false;
      this._parent.dispatchScrollEvent("ThumbPosition");
      this._parent.dispatchScrollChangedEvent();
      delete this.onMouseMove;
   };
   mx.controls.scrollClasses.ScrollThumb.prototype = new mx.skins.CustomBorder().onPress = function(Void)
   {
      this._parent.pressFocus();
      this.lastY = this._ymouse;
      this.onMouseMove = this.dragThumb;
      super.onPress();
   };
   mx.controls.scrollClasses.ScrollThumb.prototype = new mx.skins.CustomBorder().onRelease = function(Void)
   {
      this._parent.releaseFocus();
      this.stopDragThumb();
      super.onRelease();
   };
   mx.controls.scrollClasses.ScrollThumb.prototype = new mx.skins.CustomBorder().onReleaseOutside = function(Void)
   {
      this._parent.releaseFocus();
      this.stopDragThumb();
      super.onReleaseOutside();
   };
   mx.controls.scrollClasses.ScrollThumb.prototype = new mx.skins.CustomBorder().draw = function()
   {
      super.draw();
      if(this.grip_mc == undefined)
      {
         this.setSkin(3,this.gripSkin);
      }
   };
   mx.controls.scrollClasses.ScrollThumb.prototype = new mx.skins.CustomBorder().size = function()
   {
      super.size();
      this.grip_mc.move((this.__get__width() - this.grip_mc.width) / 2,(this.__get__height() - this.grip_mc.height) / 2);
   };
   mx.controls.scrollClasses.ScrollThumb = function()
   {
      super();
   }.symbolOwner = mx.skins.CustomBorder.symbolOwner;
   mx.controls.scrollClasses.ScrollThumb.prototype = new mx.skins.CustomBorder().className = "ScrollThumb";
   mx.controls.scrollClasses.ScrollThumb.prototype = new mx.skins.CustomBorder().btnOffset = 0;
   mx.controls.scrollClasses.ScrollThumb.prototype = new mx.skins.CustomBorder().horizontal = false;
   mx.controls.scrollClasses.ScrollThumb.prototype = new mx.skins.CustomBorder().idNames = new Array("l_mc","m_mc","r_mc","grip_mc");
   §§push(ASSetPropFlags(mx.controls.scrollClasses.ScrollThumb.prototype,null,1));
}
§§pop();
