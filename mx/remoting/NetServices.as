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
if(!mx.remoting.NetServices)
{
   mx.remoting.NetServices = function()
   {
      super();
   }.setDefaultGatewayUrl = function(url)
   {
      mx.remoting.NetServices.defaultGatewayUrl = url;
   };
   mx.remoting.NetServices = function()
   {
      super();
   }.setGatewayUrl = function(url)
   {
      mx.remoting.NetServices.gatewayUrl = url;
   };
   mx.remoting.NetServices = function()
   {
      super();
   }.createGatewayConnection = function(url, infoLogger)
   {
      var _loc1_ = url;
      mx.remoting.NetServices.logger = infoLogger;
      §§push(_loc1_);
      §§push(_loc2_);
      if(_loc1_ == undefined)
      {
         _loc1_ = mx.remoting.NetServices.gatewayUrl;
         if(_loc1_ == undefined)
         {
            _loc1_ = mx.remoting.NetServices.defaultGatewayUrl;
         }
      }
      if(_loc1_ == undefined)
      {
         mx.remoting.NetServices.trace("NetServices","warning",4,"createGatewayConnection - gatewayUrl is undefined");
         mx.remoting.NetServices.logger.logInfo("NetServices: createGatewayConnection - gateway url <" + _loc1_ + "> is undefined",mx.services.Log.DEBUG);
         §§push(null);
      }
      else
      {
         var _loc2_ = new mx.remoting.Connection();
         _loc2_.connect(_loc1_);
         mx.remoting.NetServices.__sharedConnections[_loc1_] = _loc2_;
         §§push(_loc2_);
      }
      var _loc0_ = §§pop();
      _loc2_ = §§pop();
      _loc1_ = §§pop();
      return _loc0_;
   };
   mx.remoting.NetServices = function()
   {
      super();
   }.getConnection = function(uri)
   {
      return mx.remoting.NetServices.__sharedConnections[uri];
   };
   mx.remoting.NetServices = function()
   {
      super();
   }.getHostUrl = function()
   {
      var _loc2_ = _root;
      §§push(_loc1_);
      §§push(_loc2_);
      if(!mx.remoting.NetServices.isHttpUrl(_loc2_._url))
      {
         mx.remoting.NetServices.trace("NetServices","warning",4,"createGatewayConnection - gatewayUrl is invalid");
         §§push(null);
      }
      else
      {
         var _loc1_ = _loc2_._url.indexOf("/",8);
         if(_loc1_ < 0)
         {
            mx.remoting.NetServices.trace("NetServices","warning",4,"createGatewayConnection - gatewayUrl is invalid");
            §§push(null);
         }
         else
         {
            §§push(_loc2_._url.substring(0,_loc1_));
         }
      }
      var _loc0_ = §§pop();
      _loc2_ = §§pop();
      _loc1_ = §§pop();
      return _loc0_;
   };
   mx.remoting.NetServices = function()
   {
      super();
   }.isHttpUrl = function(url)
   {
      return url.indexOf("http://") == 0 || url.indexOf("https://") == 0;
   };
   mx.remoting.NetServices = function()
   {
      super();
   }.getHttpUrl = function(url)
   {
      var _loc1_ = url;
      §§push(_loc1_);
      if(!mx.remoting.NetServices.isHttpUrl(_loc1_))
      {
         _loc1_ = mx.remoting.NetServices.getHostUrl() + _loc1_;
      }
      var _loc0_ = _loc1_;
      _loc1_ = §§pop();
      return _loc0_;
   };
   mx.remoting.NetServices = function()
   {
      super();
   }.trace = function(who, severity, number, message)
   {
      mx.remoting.NetServices.traceNetServices(who,severity,number,message);
   };
   mx.remoting.NetServices = function()
   {
      super();
   }.version = "1.2.0.124";
   mx.remoting.NetServices = function()
   {
      super();
   }.gatewayUrl = _root.gatewayUrl;
   mx.remoting.NetServices = function()
   {
      super();
   }.__sharedConnections = new Array();
   §§push(ASSetPropFlags(mx.remoting.NetServices.prototype,null,1));
}
§§pop();
