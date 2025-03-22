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
if(!mx.remoting.Service)
{
   mx.remoting.Service.prototype = new Object().__get__connection = function()
   {
      return this.__conn;
   };
   mx.remoting.Service.prototype = new Object().__resolve = function(methodName)
   {
      var _loc2_ = this;
      §§push(_loc1_);
      §§push(_loc2_);
      if(_loc2_._allowRes)
      {
         var _loc1_ = _loc2_.__makeOpFunc(methodName);
         _loc2_[methodName] = _loc1_;
         §§push(_loc1_);
      }
      else
      {
         §§push(null);
      }
      var _loc0_ = §§pop();
      _loc2_ = §§pop();
      _loc1_ = §§pop();
      return _loc0_;
   };
   mx.remoting.Service.prototype = new Object().__makeOpFunc = function(name)
   {
      var op = new mx.remoting.Operation(name,this);
      var _loc1_ = function()
      {
         op.invoke(arguments);
         return op.send();
      };
      _loc1_.send = function()
      {
         return op.createThenSend();
      };
      _loc1_.setResponder = function(resp)
      {
         op.responder = resp;
      };
      _loc1_.getRequest = function()
      {
         return op.request;
      };
      _loc1_.setRequest = function(val)
      {
         op.request = val;
      };
      _loc1_.addProperty("request",_loc1_.getRequest,_loc1_.setRequest);
      _loc1_.operation = op;
      var _loc0_ = _loc1_;
      _loc1_;
      return _loc0_;
   };
   mx.remoting.Service.prototype = new Object().__get__name = function()
   {
      return this.__serviceName;
   };
   mx.remoting.Service.prototype = new Object().__get__responder = function()
   {
      return this.__responder;
   };
   mx.remoting.Service = function(gatewayURI, logger, serviceName, conn, resp)
   {
      var _loc1_ = this;
      var _loc2_ = conn;
      var _loc3_ = gatewayURI;
      super();
      _loc1_.log = logger;
      _loc1_.log.logInfo("Creating Service for " + serviceName,mx.services.Log.VERBOSE);
      §§push(_loc1_);
      §§push(_loc2_);
      §§push(_loc3_);
      if(_loc3_ == "" && _loc2_ == null)
      {
         _loc3_ = mx.remoting.NetServices.gatewayUrl;
      }
      _loc3_ = mx.remoting.NetServices.getHttpUrl(_loc3_);
      if(_loc2_ == null)
      {
         _loc2_ = mx.remoting.NetServices.getConnection(_loc3_);
         if(_loc2_ == null)
         {
            _loc1_.log.logInfo("Creating gateway connection for " + _loc3_,mx.services.Log.VERBOSE);
            _loc2_ = mx.remoting.NetServices.createGatewayConnection(_loc3_,logger);
         }
      }
      _loc1_.__conn = _loc2_;
      _loc2_.updateConfig();
      _loc1_._allowRes = true;
      _loc1_.__serviceName = serviceName;
      _loc1_.__responder = resp;
      _loc1_.log.logInfo("Successfully created Service",mx.services.Log.VERBOSE);
      _loc3_ = §§pop();
      _loc2_ = §§pop();
      _loc1_ = §§pop();
   }.version = "1.2.0.124";
   mx.remoting.Service.prototype = new Object()._allowRes = false;
   §§push((mx.remoting.Service.prototype = new Object()).addProperty("connection",mx.remoting.Service.prototype = new Object().__get__connection,function()
   {
   }
   ));
   §§push((mx.remoting.Service.prototype = new Object()).addProperty("name",mx.remoting.Service.prototype = new Object().__get__name,function()
   {
   }
   ));
   §§push((mx.remoting.Service.prototype = new Object()).addProperty("responder",mx.remoting.Service.prototype = new Object().__get__responder,function()
   {
   }
   ));
   §§push(ASSetPropFlags(mx.remoting.Service.prototype,null,1));
}
§§pop();
