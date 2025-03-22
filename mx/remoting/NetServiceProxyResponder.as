if(!_global.mx)
{
   _global.mx = new Object();
}
§§pop();
if(!_global.mx.remoting)
{
   _global.mx.remoting = new Object();
}
§§pop();
if(!mx.remoting.NetServiceProxyResponder)
{
   mx.remoting.NetServiceProxyResponder.prototype = new Object().onResult = function(result)
   {
      var _loc2_ = result;
      var _loc1_ = this.service.client;
      §§push(_loc1_);
      §§push(_loc2_);
      §§push(_loc3_);
      if(_loc2_ instanceof mx.remoting.NetServiceProxy || _loc2_ instanceof mx.remoting.RecordSet)
      {
         _loc2_._setParentService(this.service);
      }
      var _loc3_ = this.methodName + "_Result";
      if(typeof _loc1_[_loc3_] == "function")
      {
         _loc1_[_loc3_].apply(_loc1_,[_loc2_]);
      }
      else if(typeof _loc1_.onResult == "function")
      {
         _loc1_.onResult(_loc2_);
      }
      else
      {
         mx.remoting.NetServices.trace("NetServices","info",1,_loc3_ + " was received from server: " + _loc2_);
      }
      _loc3_ = §§pop();
      _loc2_ = §§pop();
      _loc1_ = §§pop();
   };
   mx.remoting.NetServiceProxyResponder.prototype = new Object().onStatus = function(result)
   {
      var _loc2_ = result;
      var _loc1_ = this.service.client;
      var _loc3_ = this.methodName + "_Status";
      §§push(_loc1_);
      §§push(_loc2_);
      §§push(_loc3_);
      if(typeof _loc1_[_loc3_] == "function")
      {
         _loc1_[_loc3_].apply(_loc1_,[_loc2_]);
      }
      else if(typeof _loc1_.onStatus == "function")
      {
         _loc1_.onStatus(_loc2_);
      }
      else if(typeof _root.onStatus == "function")
      {
         _root.onStatus(_loc2_);
      }
      else if(typeof _global.System.onStatus == "function")
      {
         _global.System.onStatus(_loc2_);
      }
      else
      {
         mx.remoting.NetServices.trace("NetServices","info",2,_loc3_ + " was received from server: <" + _loc2_.level + "> " + _loc2_.description);
      }
      _loc3_ = §§pop();
      _loc2_ = §§pop();
      _loc1_ = §§pop();
   };
   §§push(ASSetPropFlags(mx.remoting.NetServiceProxyResponder.prototype,null,1));
}
§§pop();
