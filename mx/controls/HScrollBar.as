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
if(!mx.controls.HScrollBar)
{
   mx.controls.HScrollBar.prototype = new mx.controls.scrollClasses.ScrollBar().getMinWidth = function(Void)
   {
      return this._minHeight;
   };
   mx.controls.HScrollBar.prototype = new mx.controls.scrollClasses.ScrollBar().getMinHeight = function(Void)
   {
      return this._minWidth;
   };
   mx.controls.HScrollBar.prototype = new mx.controls.scrollClasses.ScrollBar().init = function(Void)
   {
      super.init();
      this._xscale = -100;
      this._rotation = -90;
   };
   mx.controls.HScrollBar.prototype = new mx.controls.scrollClasses.ScrollBar().__get__virtualHeight = function()
   {
      return this.__width;
   };
   mx.controls.HScrollBar.prototype = new mx.controls.scrollClasses.ScrollBar().isScrollBarKey = function(k)
   {
      if(k == 37)
      {
         this.scrollIt("Line",-1);
         return true;
      }
      if(k == 39)
      {
         this.scrollIt("Line",1);
         return true;
      }
      return super.isScrollBarKey(k);
   };
   mx.controls.HScrollBar = function()
   {
      super();
   }.symbolName = "HScrollBar";
   mx.controls.HScrollBar = function()
   {
      super();
   }.symbolOwner = mx.core.UIComponent;
   mx.controls.HScrollBar = function()
   {
      super();
   }.version = "2.0.2.123";
   mx.controls.HScrollBar.prototype = new mx.controls.scrollClasses.ScrollBar().className = "HScrollBar";
   mx.controls.HScrollBar.prototype = new mx.controls.scrollClasses.ScrollBar().minusMode = "Left";
   mx.controls.HScrollBar.prototype = new mx.controls.scrollClasses.ScrollBar().plusMode = "Right";
   mx.controls.HScrollBar.prototype = new mx.controls.scrollClasses.ScrollBar().minMode = "AtLeft";
   mx.controls.HScrollBar.prototype = new mx.controls.scrollClasses.ScrollBar().maxMode = "AtRight";
   §§push((mx.controls.HScrollBar.prototype = new mx.controls.scrollClasses.ScrollBar()).addProperty("virtualHeight",mx.controls.HScrollBar.prototype = new mx.controls.scrollClasses.ScrollBar().__get__virtualHeight,function()
   {
   }
   ));
   §§push(ASSetPropFlags(mx.controls.HScrollBar.prototype,null,1));
}
§§pop();
