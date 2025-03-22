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
if(!mx.remoting.PendingCall)
{
   mx.remoting.PendingCall.prototype = new Object().__get__responder = function()
   {
      return this.__responder;
   };
   mx.remoting.PendingCall.prototype = new Object().__set__responder = function(res)
   {
      this.__responder = res;
      return this.__get__responder();
   };
   mx.remoting.PendingCall.prototype = new Object().onResult = function(result)
   {
      var _loc1_ = result;
      var _loc2_ = this;
      _loc1_.serviceName = typeof _loc1_.serviceName != "function"?_loc1_.serviceName:_loc1_.servicename;
      §§push(_loc1_);
      §§push(_loc2_);
      §§push(_loc3_);
      if(_loc1_ != null)
      {
         if(_loc1_ instanceof mx.remoting.NetServiceProxy)
         {
            var serv = new mx.remoting.Service(null,null,_loc1_.serviceName,_loc2_.__service.__get__connection(),_loc2_.__service.__get__responder());
            _loc1_ = serv;
         }
         else if(_loc1_ instanceof mx.remoting.RecordSet)
         {
            var _loc3_ = new mx.remoting.NetServiceProxy(_loc2_.__service.__get__connection());
            _loc1_._setParentService(_loc3_);
            _loc1_.logger = _loc2_.__service.log;
         }
      }
      if(_loc2_.__responder != null)
      {
         _loc2_.__responder.onResult(new mx.rpc.ResultEvent(_loc1_));
      }
      if(_loc2_.__service.log != null)
      {
         _loc2_.__service.log.logInfo(_loc2_.__service.__get__name() + "." + _loc2_.__methodName + "() returned " + mx.data.binding.ObjectDumper.toString(_loc1_));
      }
      _loc3_ = §§pop();
      _loc2_ = §§pop();
      _loc1_ = §§pop();
   };
   mx.remoting.PendingCall.prototype = new Object().onStatus = function(status)
   {
      var _loc1_ = this;
      var _loc2_ = status;
      §§push(_loc1_);
      §§push(_loc2_);
      if(_loc1_.__responder != null)
      {
         _loc1_.__responder.onFault(new mx.rpc.FaultEvent(new mx.rpc.Fault(_loc2_.code,_loc2_.description,_loc2_.details,_loc2_.type)));
      }
      if(_loc1_.__service.log != null)
      {
         _loc1_.__service.log.logDebug("Service invocation failed.");
         _loc1_.__service.log.logDebug(_loc1_.__service.__get__name() + "." + _loc1_.__methodName + "() returned " + mx.data.binding.ObjectDumper.toString(_loc2_));
      }
      _loc2_ = §§pop();
      _loc1_ = §§pop();
   };
   mx.remoting.PendingCall.prototype = new Object().__get__methodName = function()
   {
      return this.__methodName;
   };
   mx.remoting.PendingCall = function(srv, methodName)
   {
      super();
      this.__service = srv;
      this.__methodName = methodName;
   }.inited = mx.remoting.NetServiceProxy.registerNetServiceProxy();
   §§push((mx.remoting.PendingCall.prototype = new Object()).addProperty("methodName",mx.remoting.PendingCall.prototype = new Object().__get__methodName,function()
   {
   }
   ));
   §§push((mx.remoting.PendingCall.prototype = new Object()).addProperty("responder",mx.remoting.PendingCall.prototype = new Object().__get__responder,mx.remoting.PendingCall.prototype = new Object().__set__responder));
   §§push(ASSetPropFlags(mx.remoting.PendingCall.prototype,null,1));
}
§§pop();
