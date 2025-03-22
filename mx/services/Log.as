class mx.services.Log
{
   static var NONE = -1;
   static var BRIEF = 0;
   static var VERBOSE = 1;
   static var DEBUG = 2;
   function Log(logLevel, name)
   {
      this.level = logLevel != undefined?logLevel:mx.services.Log.BRIEF;
      this.name = name != undefined?name:"";
   }
   function logInfo(msg, level)
   {
      var _loc1_ = this;
      var _loc2_ = level;
      §§push(_loc1_);
      §§push(_loc2_);
      if(_loc2_ == undefined)
      {
         _loc2_ = mx.services.Log.BRIEF;
      }
      if(_loc2_ <= _loc1_.level)
      {
         if(_loc2_ == mx.services.Log.DEBUG)
         {
            _loc1_.onLog(_loc1_.getDateString() + " [DEBUG] " + _loc1_.name + ": " + msg);
         }
         else
         {
            _loc1_.onLog(_loc1_.getDateString() + " [INFO] " + _loc1_.name + ": " + msg);
         }
      }
      _loc2_ = §§pop();
      _loc1_ = §§pop();
   }
   function logDebug(msg)
   {
      this.logInfo(msg,mx.services.Log.DEBUG);
   }
   function getDateString()
   {
      var _loc1_ = new Date();
      var _loc0_ = _loc1_.getMonth() + 1 + "/" + _loc1_.getDate() + " " + _loc1_.getHours() + ":" + _loc1_.getMinutes() + ":" + _loc1_.getSeconds();
      _loc1_;
      return _loc0_;
   }
   function onLog(message)
   {
      trace(message);
   }
}
