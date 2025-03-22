class it.sephiroth.PrintScreen
{
   function PrintScreen()
   {
      AsBroadcaster.initialize(this);
   }
   function print(mc, x, y, w, h)
   {
      this.broadcastMessage("onStart",mc);
      if(x == undefined)
      {
         x = 0;
      }
      if(y == undefined)
      {
         y = 0;
      }
      if(w == undefined)
      {
         w = mc._width;
      }
      if(h == undefined)
      {
         h = mc._height;
      }
      var _loc6_ = new flash.display.BitmapData(w,h,false);
      this.record = new LoadVars();
      this.record.width = w;
      this.record.height = h;
      this.record.cols = 0;
      this.record.rows = 0;
      var _loc5_ = new flash.geom.Matrix();
      _loc5_.translate(- x,- y);
      _loc6_.draw(mc,_loc5_,new flash.geom.ColorTransform(),1,new flash.geom.Rectangle(0,0,w,h));
      this.id = setInterval(this.copysource,5,this,mc,_loc6_);
   }
   function copysource(scope, movie, bit)
   {
      var _loc3_ = undefined;
      var _loc4_ = undefined;
      scope.record["px" + scope.record.rows] = new Array();
      var _loc1_ = 0;
      while(_loc1_ < bit.width)
      {
         _loc3_ = bit.getPixel(_loc1_,scope.record.rows);
         _loc4_ = _loc3_.toString(16);
         if(_loc3_ == 16777215)
         {
            _loc4_ = "";
         }
         scope.record["px" + scope.record.rows].push(_loc4_);
         _loc1_ = _loc1_ + 1;
      }
      scope.broadcastMessage("onProgress",movie,scope.record.rows,bit.height);
      scope.record.rows = scope.record.rows + 1;
      if(scope.record.rows >= bit.height)
      {
         clearInterval(scope.id);
         scope.broadcastMessage("onComplete",movie,scope.record);
         bit.dispose();
      }
   }
}
