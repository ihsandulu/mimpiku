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
if(!mx.controls.VScrollBar)
{
   mx.controls.VScrollBar.prototype = new mx.controls.scrollClasses.ScrollBar().init = function(Void)
   {
      super.init();
   };
   mx.controls.VScrollBar.prototype = new mx.controls.scrollClasses.ScrollBar().isScrollBarKey = function(k)
   {
      if(k == 38)
      {
         this.scrollIt("Line",-1);
         return true;
      }
      if(k == 40)
      {
         this.scrollIt("Line",1);
         return true;
      }
      if(k == 33)
      {
         this.scrollIt("Page",-1);
         return true;
      }
      if(k == 34)
      {
         this.scrollIt("Page",1);
         return true;
      }
      return super.isScrollBarKey(k);
   };
   mx.controls.VScrollBar = function()
   {
      super();
   }.symbolName = "VScrollBar";
   mx.controls.VScrollBar = function()
   {
      super();
   }.symbolOwner = mx.core.UIComponent;
   mx.controls.VScrollBar = function()
   {
      super();
   }.version = "2.0.2.123";
   mx.controls.VScrollBar.prototype = new mx.controls.scrollClasses.ScrollBar().className = "VScrollBar";
   mx.controls.VScrollBar.prototype = new mx.controls.scrollClasses.ScrollBar().minusMode = "Up";
   mx.controls.VScrollBar.prototype = new mx.controls.scrollClasses.ScrollBar().plusMode = "Down";
   mx.controls.VScrollBar.prototype = new mx.controls.scrollClasses.ScrollBar().minMode = "AtTop";
   mx.controls.VScrollBar.prototype = new mx.controls.scrollClasses.ScrollBar().maxMode = "AtBottom";
   §§push(ASSetPropFlags(mx.controls.VScrollBar.prototype,null,1));
}
§§pop();
