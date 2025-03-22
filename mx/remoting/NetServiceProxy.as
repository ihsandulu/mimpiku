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
if(!mx.remoting.NetServiceProxy)
{
   mx.remoting.NetServiceProxy.prototype = new Object()._setParentService = function(service)
   {
      this.nc = service.nc;
      this.client = service.client;
   };
   mx.remoting.NetServiceProxy.prototype = new Object().__resolve = function(methodName)
   {
      var _loc1_ = this;
      var _loc2_ = arguments;
      §§push(_loc1_);
      §§push(_loc2_);
      §§push(_loc3_);
      if(_loc1_._allowRes)
      {
         var _loc3_ = function()
         {
            var _loc1_ = this;
            var _loc2_ = arguments;
            §§push(_loc1_);
            §§push(_loc2_);
            if(_loc1_.client != null)
            {
               _loc2_.unshift(new mx.remoting.NetServiceProxyResponder(_loc1_,methodName));
            }
            else if(typeof _loc2_[0].onResult != "function")
            {
               mx.remoting.NetServices.trace("NetServices","warning",3,"There is no defaultResponder, and no responder was given in call to " + methodName);
               _loc2_.unshift(new mx.remoting.NetServiceProxyResponder(_loc1_,methodName));
            }
            if(typeof _loc1_.serviceName == "function")
            {
               _loc1_.serviceName = _loc1_.servicename;
            }
            _loc2_.unshift(_loc1_.serviceName + "." + methodName);
            var _loc0_ = _loc1_.nc.call.apply(_loc1_.nc,_loc2_);
            _loc2_ = §§pop();
            _loc1_ = §§pop();
            return _loc0_;
         };
         §§push(_loc3_);
      }
      else
      {
         §§push(null);
      }
      var _loc0_ = §§pop();
      _loc3_ = §§pop();
      _loc2_ = §§pop();
      _loc1_ = §§pop();
      return _loc0_;
   };
   mx.remoting.NetServiceProxy = function(netC, servName, cli)
   {
      var _loc1_ = this;
      super();
      §§push(_loc1_);
      if(netC != null)
      {
         _loc1_.nc = netC;
         _loc1_.serviceName = servName;
         _loc1_.client = cli;
      }
      _loc1_._allowRes = true;
      _loc1_ = §§pop();
   }.registerNetServiceProxy = function()
   {
      Object.registerClass("NetServiceProxy",mx.remoting.NetServiceProxy);
      return true;
   };
   mx.remoting.NetServiceProxy = function(netC, servName, cli)
   {
      var _loc1_ = this;
      super();
      §§push(_loc1_);
      if(netC != null)
      {
         _loc1_.nc = netC;
         _loc1_.serviceName = servName;
         _loc1_.client = cli;
      }
      _loc1_._allowRes = true;
      _loc1_ = §§pop();
   }.init = mx.remoting.NetServiceProxy.registerNetServiceProxy();
   mx.remoting.NetServiceProxy.prototype = new Object()._allowRes = false;
   §§push(ASSetPropFlags(mx.remoting.NetServiceProxy.prototype,null,1));
}
§§pop();
