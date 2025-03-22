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
if(!mx.remoting.Connection)
{
   mx.remoting.Connection.prototype = new NetConnection().getService = function(serviceName, client)
   {
      var _loc1_ = new mx.remoting.NetServiceProxy(this,serviceName,client);
      var _loc0_ = _loc1_;
      _loc1_;
      return _loc0_;
   };
   mx.remoting.Connection.prototype = new NetConnection().setCredentials = function(userId, password)
   {
      this.addHeader("Credentials",false,{userid:userId,password:password});
   };
   mx.remoting.Connection.prototype = new NetConnection().clone = function()
   {
      var _loc1_ = new mx.remoting.Connection();
      _loc1_.connect(this.uri);
      var _loc0_ = _loc1_;
      _loc1_;
      return _loc0_;
   };
   mx.remoting.Connection.prototype = new NetConnection().getDebugId = function()
   {
      return null;
   };
   mx.remoting.Connection.prototype = new NetConnection().getDebugConfig = function()
   {
      return null;
   };
   mx.remoting.Connection.prototype = new NetConnection().setDebugId = function(id)
   {
   };
   mx.remoting.Connection.prototype = new NetConnection().call = function()
   {
      super.call.apply(super,arguments);
   };
   mx.remoting.Connection.prototype = new NetConnection().close = function()
   {
      super.close();
   };
   mx.remoting.Connection.prototype = new NetConnection().connect = function(url)
   {
      return super.connect(url);
   };
   mx.remoting.Connection.prototype = new NetConnection().addHeader = function(name, mustUnderstand, obj)
   {
      super.addHeader(name,mustUnderstand,obj);
   };
   mx.remoting.Connection.prototype = new NetConnection().trace = function(traceObj)
   {
   };
   mx.remoting.Connection.prototype = new NetConnection().AppendToGatewayUrl = function(urlSuffix)
   {
      var _loc1_ = this;
      _loc1_.__urlSuffix = urlSuffix;
      §§push(_loc1_);
      §§push(_loc2_);
      if(_loc1_.__originalUrl == null)
      {
         _loc1_.__originalUrl = _loc1_.uri;
      }
      var _loc2_ = _loc1_.__originalUrl + urlSuffix;
      _loc1_.connect(_loc2_);
      _loc2_ = §§pop();
      _loc1_ = §§pop();
   };
   mx.remoting.Connection.prototype = new NetConnection().ReplaceGatewayUrl = function(newUrl)
   {
      this.connect(newUrl);
   };
   mx.remoting.Connection.prototype = new NetConnection().RequestPersistentHeader = function(info)
   {
      var _loc1_ = info;
      this.addHeader(_loc1_.name,_loc1_.mustUnderstand,_loc1_.data);
      _loc1_;
   };
   mx.remoting.Connection = function()
   {
      super();
   }.version = "1.2.0.124";
   §§push(ASSetPropFlags(mx.remoting.Connection.prototype,null,1));
}
§§pop();
