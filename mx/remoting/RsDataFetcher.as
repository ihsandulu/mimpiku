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
if(!mx.remoting.RsDataFetcher)
{
   mx.remoting.RsDataFetcher.prototype = new Object().disable = function()
   {
      this.mEnabled = false;
   };
   mx.remoting.RsDataFetcher.prototype = new Object().doNext = function()
   {
      var _loc1_ = this;
      §§push(_loc1_);
      §§push(_loc2_);
      if(_loc1_.mEnabled)
      {
         while(true)
         {
            if(_loc1_.mNextRecord >= _loc1_.mRecordSet.getRemoteLength())
            {
               break;
            }
            var _loc2_ = new mx.remoting.RsDataRange(_loc1_.mNextRecord,_loc1_.mNextRecord + _loc1_.mIncrement - 1);
            _loc1_.mHighestRequested = _loc1_.mRecordSet.requestRange(_loc2_);
            _loc1_.mNextRecord = _loc1_.mNextRecord + _loc1_.mIncrement;
            if(_loc1_.mHighestRequested > 0)
            {
               break;
            }
         }
      }
      _loc2_ = §§pop();
      _loc1_ = §§pop();
   };
   mx.remoting.RsDataFetcher.prototype = new Object().modelChanged = function(eventObj)
   {
      var _loc1_ = this;
      var _loc2_ = eventObj;
      §§push(_loc1_);
      §§push(_loc2_);
      if(_loc2_.eventName == "updateItems" && _loc2_.firstItem <= _loc1_.mHighestRequested && _loc2_.lastItem >= _loc1_.mHighestRequested)
      {
         _loc1_.doNext();
      }
      if(_loc2_.eventName == "allRows")
      {
         _loc1_.disable();
      }
      _loc2_ = §§pop();
      _loc1_ = §§pop();
   };
   §§push(ASSetPropFlags(mx.remoting.RsDataFetcher.prototype,null,1));
}
§§pop();
