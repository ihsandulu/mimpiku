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
if(!mx.remoting.RecordSet)
{
   mx.remoting.RecordSet.prototype = new Object().addItem = function(item)
   {
      this.addItemAt(this.__get__length(),item);
   };
   mx.remoting.RecordSet.prototype = new Object().addItemAt = function(index, item)
   {
      var _loc1_ = index;
      var _loc2_ = this;
      var _loc3_ = true;
      §§push(_loc1_);
      §§push(_loc2_);
      §§push(_loc3_);
      if(_loc1_ < _loc2_.__get__length() && _loc1_ >= 0)
      {
         _loc2_.items.splice(_loc1_,0,item);
         addr55:
         if(_loc3_)
         {
            _loc2_.uniqueID = _loc2_.uniqueID + 1;
            item.__ID__ = _loc2_.uniqueID;
         }
         _loc2_.updateViews("addItems",_loc1_,_loc1_);
      }
      else if(_loc1_ == _loc2_.__get__length())
      {
         _loc2_.items[_loc1_] = item;
         §§goto(addr55);
      }
      else
      {
         _loc3_ = false;
         mx.remoting.NetServices.trace("Cannot add an item outside the bounds of the RecordSet");
      }
      _loc3_ = §§pop();
      _loc2_ = §§pop();
      _loc1_ = §§pop();
   };
   mx.remoting.RecordSet.prototype = new Object().addEventListener = function(event, listener)
   {
   };
   mx.remoting.RecordSet.prototype = new Object().clear = function()
   {
      var _loc1_ = this;
      §§push(_loc1_);
      §§push(_loc2_);
      if(!_loc1_.checkLocal())
      {
         var _loc2_ = _loc1_.items.length;
         _loc1_.items.splice(0);
         _loc1_.uniqueID = 0;
         _loc1_.updateViews("removeItems",0,_loc2_);
      }
      _loc2_ = §§pop();
      _loc1_ = §§pop();
   };
   mx.remoting.RecordSet.prototype = new Object().contains = function(itmToCheck)
   {
      var _loc2_ = itmToCheck;
      §§push(_loc1_);
      §§push(_loc2_);
      §§push(_loc3_);
      if(this.isObjectEmpty(_loc2_))
      {
         §§push(false);
      }
      else
      {
         var itemAtIndex;
         var _loc3_ = undefined;
         var _loc1_ = 0;
         loop0:
         while(true)
         {
            if(_loc1_ < this.items.length)
            {
               itemAtIndex = this.items[_loc1_];
               _loc3_ = true;
               §§enumerate(_loc2_);
               while(true)
               {
                  if((var _loc0_ = §§pop()) != null)
                  {
                     var t = _loc0_;
                     if(_loc2_[t] != itemAtIndex[t])
                     {
                        _loc3_ = false;
                        if(!_loc3_)
                        {
                           break;
                        }
                     }
                     else
                     {
                        continue;
                     }
                  }
                  else if(!_loc3_)
                  {
                     break;
                  }
                  break loop0;
               }
               _loc1_ = _loc1_ + 1;
               continue;
            }
            §§push(false);
            break;
         }
      }
      _loc0_ = §§pop();
      _loc3_ = §§pop();
      _loc2_ = §§pop();
      _loc1_ = §§pop();
      return _loc0_;
   };
   mx.remoting.RecordSet.prototype = new Object().getColumnNames = function()
   {
      return this.mTitles;
   };
   mx.remoting.RecordSet.prototype = new Object().__get__columnNames = function()
   {
      return this.getColumnNames();
   };
   mx.remoting.RecordSet.prototype = new Object().getLocalLength = function()
   {
      return this.items.length;
   };
   mx.remoting.RecordSet.prototype = new Object().getLength = function()
   {
      var _loc1_ = this;
      var _loc0_ = _loc1_.mRecordSetID != null?_loc1_.mTotalCount:_loc1_.items.length;
      _loc1_;
      return _loc0_;
   };
   mx.remoting.RecordSet.prototype = new Object().getIterator = function()
   {
      var _loc1_ = new mx.remoting.RecordSetIterator(this);
      var _loc0_ = _loc1_;
      _loc1_;
      return _loc0_;
   };
   mx.remoting.RecordSet.prototype = new Object().__get__length = function()
   {
      return this.getLength();
   };
   mx.remoting.RecordSet.prototype = new Object().getItemAt = function(index)
   {
      var _loc1_ = index;
      var _loc2_ = this;
      §§push(_loc1_);
      §§push(_loc2_);
      §§push(_loc3_);
      if(_loc1_ < 0 || _loc1_ >= _loc2_.__get__length())
      {
         §§push(null);
      }
      else if(_loc2_.mRecordSetID == null)
      {
         §§push(_loc2_.items[_loc1_]);
      }
      else
      {
         _loc2_.requestRecord(_loc1_);
         var _loc3_ = _loc2_.items[_loc1_];
         §§push(_loc3_ == 1?"in progress":_loc3_);
      }
      var _loc0_ = §§pop();
      _loc3_ = §§pop();
      _loc2_ = §§pop();
      _loc1_ = §§pop();
      return _loc0_;
   };
   mx.remoting.RecordSet.prototype = new Object().getItemID = function(index)
   {
      return this.items[index].__ID__;
   };
   mx.remoting.RecordSet.prototype = new Object().__get__items = function()
   {
      return this._items;
   };
   mx.remoting.RecordSet.prototype = new Object().initialize = function(info)
   {
   };
   mx.remoting.RecordSet.prototype = new Object().filter = function(filterFunction, context)
   {
      §§push(_loc1_);
      §§push(_loc2_);
      §§push(_loc3_);
      if(this.checkLocal())
      {
         §§push(undefined);
      }
      else
      {
         var _loc3_ = new mx.remoting.RecordSet(this.mTitles);
         var rcount = this.__get__length();
         var _loc2_ = 0;
         while(_loc2_ < rcount)
         {
            var _loc1_ = this.getItemAt(_loc2_);
            if(_loc1_ != null && _loc1_ != 1 && filterFunction(_loc1_,context))
            {
               _loc3_.addItem(_loc1_);
            }
            _loc2_ = _loc2_ + 1;
         }
         §§push(_loc3_);
      }
      var _loc0_ = §§pop();
      _loc3_ = §§pop();
      _loc2_ = §§pop();
      _loc1_ = §§pop();
      return _loc0_;
   };
   mx.remoting.RecordSet.prototype = new Object().sortItems = function(compareFunc, optionFlags)
   {
      var _loc1_ = this;
      §§push(_loc1_);
      if(!_loc1_.checkLocal())
      {
         _loc1_.items.sort(compareFunc,optionFlags);
         _loc1_.updateViews("sort");
      }
      _loc1_ = §§pop();
   };
   mx.remoting.RecordSet.prototype = new Object().sortItemsBy = function(fieldNames, order, optionFlags)
   {
      var _loc1_ = this;
      §§push(_loc1_);
      if(!_loc1_.checkLocal())
      {
         if(typeof order == "string")
         {
            _loc1_.items.sortOn(fieldNames);
            if(order.toUpperCase() == "DESC")
            {
               _loc1_.items.reverse();
            }
         }
         else
         {
            _loc1_.items.sortOn(fieldNames,optionFlags);
         }
         _loc1_.updateViews("sort");
      }
      _loc1_ = §§pop();
   };
   mx.remoting.RecordSet.prototype = new Object().sort = function(compareFunc)
   {
      var _loc1_ = this;
      §§push(_loc1_);
      if(!_loc1_.checkLocal())
      {
         _loc1_.items.sort(compareFunc);
         _loc1_.updateViews("sort");
      }
      _loc1_ = §§pop();
   };
   mx.remoting.RecordSet.prototype = new Object().isEmpty = function()
   {
      return this.items.length == 0;
   };
   mx.remoting.RecordSet.prototype = new Object().isLocal = function()
   {
      return this.mRecordSetID == null;
   };
   mx.remoting.RecordSet.prototype = new Object().isFullyPopulated = function()
   {
      return this.isLocal();
   };
   mx.remoting.RecordSet.prototype = new Object().getRemoteLength = function()
   {
      var _loc1_ = this;
      var _loc0_ = !!_loc1_.isLocal()?_loc1_.mRecordsAvailable:_loc1_.mTotalCount;
      _loc1_;
      return _loc0_;
   };
   mx.remoting.RecordSet.prototype = new Object().getNumberAvailable = function()
   {
      var _loc1_ = this;
      var _loc0_ = !!_loc1_.isLocal()?_loc1_.getLength():_loc1_.mRecordsAvailable;
      _loc1_;
      return _loc0_;
   };
   mx.remoting.RecordSet.prototype = new Object().replaceItemAt = function(index, item)
   {
      var _loc1_ = index;
      var _loc2_ = this;
      §§push(_loc1_);
      §§push(_loc2_);
      §§push(_loc3_);
      if(_loc1_ >= 0 && _loc1_ <= _loc2_.__get__length())
      {
         var _loc3_ = _loc2_.getItemID(_loc1_);
         _loc2_.items[_loc1_] = item;
         _loc2_.items[_loc1_].__ID__ = _loc3_;
         _loc2_.updateViews("updateItems",_loc1_,_loc1_);
      }
      _loc3_ = §§pop();
      _loc2_ = §§pop();
      _loc1_ = §§pop();
   };
   mx.remoting.RecordSet.prototype = new Object().removeAll = function()
   {
      this.clear();
   };
   mx.remoting.RecordSet.prototype = new Object().removeItemAt = function(index)
   {
      var _loc1_ = index;
      var _loc2_ = this;
      var _loc3_ = _loc2_._items[_loc1_];
      _loc2_._items.splice(_loc1_,1);
      var rItems = [_loc2_._items[_loc1_]];
      var rIDs = [_loc2_.getItemID(_loc1_)];
      _loc2_.dispatchEvent({type:"modelChanged",eventName:"removeItems",firstItem:_loc1_,lastItem:_loc1_,removedItems:rItems,removedIDs:rIDs});
      var _loc0_ = _loc3_;
      _loc3_;
      _loc2_;
      _loc1_;
      return _loc0_;
   };
   mx.remoting.RecordSet.prototype = new Object().removeEventListener = function(event, listener)
   {
   };
   mx.remoting.RecordSet.prototype = new Object().requestRange = function(range)
   {
      var _loc1_ = range.getStart();
      var _loc2_ = range.getEnd();
      var _loc0_ = this.internalRequestRange(_loc1_,_loc2_);
      _loc2_;
      _loc1_;
      return _loc0_;
   };
   mx.remoting.RecordSet.prototype = new Object().setDeliveryMode = function(mode, pagesize, numPrefetchPages)
   {
      var _loc1_ = this;
      var _loc2_ = pagesize;
      var _loc3_ = numPrefetchPages;
      _loc1_.mDeliveryMode = mode.toLowerCase();
      _loc1_.stopFetchAll();
      §§push(_loc1_);
      §§push(_loc2_);
      §§push(_loc3_);
      if(_loc2_ == null || _loc2_ <= 0)
      {
         _loc2_ = 25;
      }
      switch(_loc1_.mDeliveryMode)
      {
         case "ondemand":
            break;
         case "page":
            if(_loc3_ == null)
            {
               _loc3_ = 0;
            }
            _loc1_.mPageSize = _loc2_;
            _loc1_.mNumPrefetchPages = _loc3_;
            break;
         case "fetchall":
            _loc1_.stopFetchAll();
            _loc1_.startFetchAll(_loc2_);
            break;
         default:
            mx.remoting.NetServices.trace("RecordSet","warning",107,"SetDeliveryMode: unknown mode string");
      }
      _loc3_ = §§pop();
      _loc2_ = §§pop();
      _loc1_ = §§pop();
   };
   mx.remoting.RecordSet.prototype = new Object().editField = function(index, fieldName, value)
   {
      this.changeFieldValue(index,fieldName,value);
   };
   mx.remoting.RecordSet.prototype = new Object().getEditingData = function(index, fieldName)
   {
      return this.items[index][fieldName];
   };
   mx.remoting.RecordSet.prototype = new Object().setField = function(index, fieldName, value)
   {
      this.changeFieldValue(index,fieldName,value);
   };
   mx.remoting.RecordSet.prototype = new Object().changeFieldValue = function(index, fieldName, value)
   {
      var _loc1_ = index;
      var _loc2_ = this;
      §§push(_loc1_);
      §§push(_loc2_);
      if(!_loc2_.checkLocal())
      {
         if(!(_loc1_ < 0 || _loc1_ >= _loc2_.getLength()))
         {
            _loc2_.items[_loc1_][fieldName] = value;
            _loc2_.updateViews("updateItems",_loc1_,_loc1_);
         }
      }
      _loc2_ = §§pop();
      _loc1_ = §§pop();
   };
   mx.remoting.RecordSet.prototype = new Object().isObjectEmpty = function(objToCheck)
   {
      var _loc2_ = objToCheck;
      var _loc1_ = true;
      §§enumerate(_loc2_);
      §§push(_loc1_);
      §§push(_loc2_);
      if((var _loc0_ = _loc3_) != null)
      {
         var _loc3_ = _loc0_;
         _loc1_ = false;
         §§push(_loc1_);
      }
      else
      {
         §§push(_loc1_);
      }
      _loc0_ = §§pop();
      _loc3_ = §§pop();
      _loc2_ = §§pop();
      _loc1_ = §§pop();
      return _loc0_;
   };
   mx.remoting.RecordSet.prototype = new Object().arrayToObject = function(anArray)
   {
      §§push(_loc1_);
      §§push(_loc2_);
      §§push(_loc3_);
      if(this.mTitles == null)
      {
         mx.remoting.NetServices.trace("RecordSet","warning",105,"getItem: titles are not available");
         §§push(null);
      }
      else
      {
         var _loc3_ = new Object();
         var alen = anArray.length;
         var _loc2_ = undefined;
         var _loc1_ = 0;
         while(_loc1_ < alen)
         {
            _loc2_ = this.mTitles[_loc1_];
            if(_loc2_ == null)
            {
               _loc2_ = "column" + _loc1_ + 1;
            }
            _loc3_[_loc2_] = anArray[_loc1_];
            _loc1_ = _loc1_ + 1;
         }
         §§push(_loc3_);
      }
      var _loc0_ = §§pop();
      _loc3_ = §§pop();
      _loc2_ = §§pop();
      _loc1_ = §§pop();
      return _loc0_;
   };
   mx.remoting.RecordSet.prototype = new Object().checkLocal = function()
   {
      if(this.isLocal())
      {
         return false;
      }
      mx.remoting.NetServices.trace("RecordSet","warning",108,"Operation not allowed on partial recordset");
      return true;
   };
   mx.remoting.RecordSet.prototype = new Object().getRecordSetService = function()
   {
      var _loc1_ = this;
      §§push(_loc1_);
      if(_loc1_.mRecordSetService == null)
      {
         if(_loc1_.gateway_conn == null)
         {
            _loc1_.gateway_conn = mx.remoting.NetServices.createGatewayConnection();
         }
         else if(_global.netDebugInstance != undefined)
         {
            _loc1_.gateway_conn = _loc1_.gateway_conn.clone();
         }
         if(_global.netDebugInstance != undefined)
         {
            _loc1_.gateway_conn.setupRecordSet();
            _loc1_.gateway_conn.setDebugId("RecordSet " + _loc1_.mRecordSetID);
         }
         _loc1_.mRecordSetService = _loc1_.gateway_conn.getService(_loc1_.serviceName,_loc1_);
         if(_loc1_.mRecordSetService == null)
         {
            mx.remoting.NetServices.trace("RecordSet","warning",101,"Failed to create RecordSet service");
            _loc1_.mRecordSetService = null;
         }
      }
      var _loc0_ = _loc1_.mRecordSetService;
      _loc1_ = §§pop();
      return _loc0_;
   };
   mx.remoting.RecordSet.prototype = new Object().internalRequestRange = function(index, lastIndex)
   {
      var _loc1_ = index;
      var _loc2_ = this;
      var highestRequested = -1;
      §§push(_loc1_);
      §§push(_loc2_);
      §§push(_loc3_);
      if(_loc1_ < 0)
      {
         _loc1_ = 0;
      }
      if(lastIndex >= _loc2_.getRemoteLength())
      {
         lastIndex = _loc2_.getRemoteLength() - 1;
      }
      var _loc3_ = undefined;
      var last;
      while(_loc1_ <= lastIndex)
      {
         while(_loc1_ <= lastIndex && _loc2_.items[_loc1_] != null)
         {
            _loc1_ = _loc1_ + 1;
         }
         _loc3_ = _loc1_;
         while(_loc1_ <= lastIndex && _loc2_.items[_loc1_] == null)
         {
            _loc2_.mOutstandingRecordCount = _loc2_.mOutstandingRecordCount + 1;
            _loc2_.items[_loc1_] = 1;
            _loc1_ = _loc1_ + 1;
         }
         last = _loc1_ - 1;
         if(_loc3_ <= last)
         {
            _loc2_.logger.logInfo(" Fetching records from index [" + _loc3_ + "] to index [" + last + "]");
            _loc2_.getRecordSetService().getRecords(_loc2_.mRecordSetID,_loc3_ + 1,last - _loc3_ + 1);
            highestRequested = last;
            _loc2_.updateViews("fetchRows",_loc3_,last);
         }
      }
      var _loc0_ = highestRequested;
      _loc3_ = §§pop();
      _loc2_ = §§pop();
      _loc1_ = §§pop();
      return _loc0_;
   };
   mx.remoting.RecordSet.prototype = new Object().removeItems = function(index, len)
   {
      var _loc3_ = index;
      var _loc2_ = new Array();
      var _loc1_ = 0;
      while(_loc1_ < len)
      {
         _loc2_.push(this.getItemID(_loc3_ + _loc1_));
         _loc1_ = _loc1_ + 1;
      }
      var oldItems = this.items.splice(_loc3_,len);
      this.dispatchEvent({type:"modelChanged",eventName:"removeItems",firstItem:_loc3_,lastItem:_loc3_ + len - 1,removedItems:oldItems,removedIDs:_loc2_});
      _loc3_;
      _loc2_;
      _loc1_;
   };
   mx.remoting.RecordSet.prototype = new Object().getRecords_Result = function(info)
   {
      var _loc1_ = this;
      var _loc2_ = info;
      _loc1_.setData(_loc2_.Cursor - 1,_loc2_.Page);
      _loc1_.mOutstandingRecordCount = _loc1_.mOutstandingRecordCount - _loc2_.Page.length;
      _loc1_.updateViews("updateItems",_loc2_.Cursor - 1,_loc2_.Cursor - 1 + _loc2_.Page.length - 1);
      §§push(_loc1_);
      §§push(_loc2_);
      if(_loc1_.mRecordsAvailable == _loc1_.mTotalCount && !_loc1_.mAllNotified)
      {
         _loc1_.updateViews("allRows");
         _loc1_.mRecordSetService.release();
         _loc1_.mAllNotified = true;
         _loc1_.mRecordSetID = null;
         _loc1_.mRecordSetService = null;
      }
      _loc2_ = §§pop();
      _loc1_ = §§pop();
   };
   mx.remoting.RecordSet.prototype = new Object().release_Result = function()
   {
   };
   mx.remoting.RecordSet.prototype = new Object().requestOneRecord = function(index)
   {
      var _loc1_ = this;
      var _loc2_ = index;
      §§push(_loc1_);
      §§push(_loc2_);
      if(_loc1_.items[_loc2_] == null)
      {
         if(_loc1_.mDeliveryMode == "ondemand")
         {
            _loc1_.logger.logInfo(" INFO: Fetching Record [" + _loc2_ + "]");
         }
         _loc1_.getRecordSetService().getRecords(_loc1_.mRecordSetID,_loc2_ + 1,1);
         _loc1_.mOutstandingRecordCount = _loc1_.mOutstandingRecordCount + 1;
         _loc1_.items[_loc2_] = 1;
         _loc1_.updateViews("fetchRows",_loc2_,_loc2_);
      }
      _loc2_ = §§pop();
      _loc1_ = §§pop();
   };
   mx.remoting.RecordSet.prototype = new Object().requestRecord = function(index)
   {
      var _loc1_ = this;
      §§push(_loc1_);
      §§push(_loc2_);
      §§push(_loc3_);
      if(_loc1_.mDeliveryMode != "page")
      {
         _loc1_.requestOneRecord(index);
      }
      else
      {
         var _loc2_ = int(index / _loc1_.mPageSize) * _loc1_.mPageSize;
         var _loc3_ = _loc2_ + _loc1_.mPageSize * (_loc1_.mNumPrefetchPages + 1) - 1;
         _loc1_.internalRequestRange(_loc2_,_loc3_);
      }
      _loc3_ = §§pop();
      _loc2_ = §§pop();
      _loc1_ = §§pop();
   };
   mx.remoting.RecordSet.prototype = new Object()._setParentService = function(service)
   {
      this.gateway_conn = service.nc;
   };
   mx.remoting.RecordSet.prototype = new Object().setData = function(start, dataArray)
   {
      var _loc1_ = this;
      var datalen = dataArray.length;
      var _loc3_ = undefined;
      var rec;
      var _loc2_ = 0;
      while(_loc2_ < datalen)
      {
         _loc3_ = _loc2_ + start;
         rec = _loc1_.items[_loc3_];
         if(rec != null && rec != 1)
         {
            mx.remoting.NetServices.trace("RecordSet","warning",106,"Already got record # " + _loc3_);
         }
         else
         {
            _loc1_.mRecordsAvailable = _loc1_.mRecordsAvailable + 1;
         }
         _loc1_.items[_loc3_] = _loc1_.arrayToObject(dataArray[_loc2_]);
         _loc1_.uniqueID = _loc1_.uniqueID + 1;
         _loc1_.items[_loc3_].__ID__ = _loc1_.uniqueID;
         _loc2_ = _loc2_ + 1;
      }
      _loc3_;
      _loc2_;
      _loc1_;
   };
   mx.remoting.RecordSet.prototype = new Object().startFetchAll = function(pagesize)
   {
      var _loc1_ = this;
      §§push(_loc1_);
      if(_loc1_.mDataFetcher != null)
      {
         _loc1_.mDataFetcher.disable();
      }
      _loc1_.mDataFetcher = new mx.remoting.RsDataFetcher(_loc1_,pagesize);
      _loc1_ = §§pop();
   };
   mx.remoting.RecordSet.prototype = new Object().stopFetchAll = function()
   {
      this.mDataFetcher.disable();
      this.mDataFetcher = null;
   };
   mx.remoting.RecordSet.prototype = new Object().updateViews = function(event, first, last)
   {
      this.dispatchEvent({type:"modelChanged",eventName:event,firstItem:first,lastItem:last});
   };
   mx.remoting.RecordSet = function(columnNames)
   {
      var _loc1_ = this;
      super();
      mx.events.EventDispatcher.initialize(_loc1_);
      _loc1_._items = new Array();
      _loc1_.uniqueID = 0;
      §§push(_loc1_);
      if(_loc1_.mTitles == null)
      {
         if(_loc1_.serverInfo == null)
         {
            if(_loc1_.serverinfo != null)
            {
               _loc1_.serverInfo = _loc1_.serverinfo;
            }
         }
         if(_loc1_.serverInfo == null)
         {
            _loc1_.mTitles = columnNames;
         }
         else if(_loc1_.serverInfo.version != 1)
         {
            mx.remoting.NetServices.trace("RecordSet","warning",100,"Received incompatible RecordSet version from server");
         }
         else
         {
            _loc1_.mTitles = _loc1_.serverInfo.columnNames;
            _loc1_.mRecordsAvailable = 0;
            _loc1_.setData(_loc1_.serverInfo.cursor != null?_loc1_.serverInfo.cursor - 1:0,_loc1_.serverInfo.initialData);
            if(_loc1_.serverInfo.initialData.length != _loc1_.serverInfo.totalCount)
            {
               _loc1_.mRecordSetID = _loc1_.serverInfo.id;
               if(_loc1_.mRecordSetID != null)
               {
                  _loc1_.serviceName = _loc1_.serverInfo.serviceName != null?_loc1_.serverInfo.serviceName:"RecordSet";
                  _loc1_.mTotalCount = _loc1_.serverInfo.totalCount;
                  _loc1_.mDeliveryMode = "ondemand";
                  _loc1_.mAllNotified = false;
                  _loc1_.mOutstandingRecordCount = 0;
               }
               else
               {
                  mx.remoting.NetServices.trace("RecordSet","warning",102,"Missing some records, but there\'s no RecordSet id");
               }
            }
            _loc1_.serverInfo = null;
         }
      }
      _loc1_ = §§pop();
   }.registerRecordSet = function()
   {
      Object.registerClass("RecordSet",mx.remoting.RecordSet);
      return true;
   };
   mx.remoting.RecordSet = function(columnNames)
   {
      var _loc1_ = this;
      super();
      mx.events.EventDispatcher.initialize(_loc1_);
      _loc1_._items = new Array();
      _loc1_.uniqueID = 0;
      §§push(_loc1_);
      if(_loc1_.mTitles == null)
      {
         if(_loc1_.serverInfo == null)
         {
            if(_loc1_.serverinfo != null)
            {
               _loc1_.serverInfo = _loc1_.serverinfo;
            }
         }
         if(_loc1_.serverInfo == null)
         {
            _loc1_.mTitles = columnNames;
         }
         else if(_loc1_.serverInfo.version != 1)
         {
            mx.remoting.NetServices.trace("RecordSet","warning",100,"Received incompatible RecordSet version from server");
         }
         else
         {
            _loc1_.mTitles = _loc1_.serverInfo.columnNames;
            _loc1_.mRecordsAvailable = 0;
            _loc1_.setData(_loc1_.serverInfo.cursor != null?_loc1_.serverInfo.cursor - 1:0,_loc1_.serverInfo.initialData);
            if(_loc1_.serverInfo.initialData.length != _loc1_.serverInfo.totalCount)
            {
               _loc1_.mRecordSetID = _loc1_.serverInfo.id;
               if(_loc1_.mRecordSetID != null)
               {
                  _loc1_.serviceName = _loc1_.serverInfo.serviceName != null?_loc1_.serverInfo.serviceName:"RecordSet";
                  _loc1_.mTotalCount = _loc1_.serverInfo.totalCount;
                  _loc1_.mDeliveryMode = "ondemand";
                  _loc1_.mAllNotified = false;
                  _loc1_.mOutstandingRecordCount = 0;
               }
               else
               {
                  mx.remoting.NetServices.trace("RecordSet","warning",102,"Missing some records, but there\'s no RecordSet id");
               }
            }
            _loc1_.serverInfo = null;
         }
      }
      _loc1_ = §§pop();
   }.version = "1.2.0.124";
   mx.remoting.RecordSet = function(columnNames)
   {
      var _loc1_ = this;
      super();
      mx.events.EventDispatcher.initialize(_loc1_);
      _loc1_._items = new Array();
      _loc1_.uniqueID = 0;
      §§push(_loc1_);
      if(_loc1_.mTitles == null)
      {
         if(_loc1_.serverInfo == null)
         {
            if(_loc1_.serverinfo != null)
            {
               _loc1_.serverInfo = _loc1_.serverinfo;
            }
         }
         if(_loc1_.serverInfo == null)
         {
            _loc1_.mTitles = columnNames;
         }
         else if(_loc1_.serverInfo.version != 1)
         {
            mx.remoting.NetServices.trace("RecordSet","warning",100,"Received incompatible RecordSet version from server");
         }
         else
         {
            _loc1_.mTitles = _loc1_.serverInfo.columnNames;
            _loc1_.mRecordsAvailable = 0;
            _loc1_.setData(_loc1_.serverInfo.cursor != null?_loc1_.serverInfo.cursor - 1:0,_loc1_.serverInfo.initialData);
            if(_loc1_.serverInfo.initialData.length != _loc1_.serverInfo.totalCount)
            {
               _loc1_.mRecordSetID = _loc1_.serverInfo.id;
               if(_loc1_.mRecordSetID != null)
               {
                  _loc1_.serviceName = _loc1_.serverInfo.serviceName != null?_loc1_.serverInfo.serviceName:"RecordSet";
                  _loc1_.mTotalCount = _loc1_.serverInfo.totalCount;
                  _loc1_.mDeliveryMode = "ondemand";
                  _loc1_.mAllNotified = false;
                  _loc1_.mOutstandingRecordCount = 0;
               }
               else
               {
                  mx.remoting.NetServices.trace("RecordSet","warning",102,"Missing some records, but there\'s no RecordSet id");
               }
            }
            _loc1_.serverInfo = null;
         }
      }
      _loc1_ = §§pop();
   }.init = mx.remoting.RecordSet.registerRecordSet();
   §§push((mx.remoting.RecordSet.prototype = new Object()).addProperty("columnNames",mx.remoting.RecordSet.prototype = new Object().__get__columnNames,function()
   {
   }
   ));
   §§push((mx.remoting.RecordSet.prototype = new Object()).addProperty("items",mx.remoting.RecordSet.prototype = new Object().__get__items,function()
   {
   }
   ));
   §§push((mx.remoting.RecordSet.prototype = new Object()).addProperty("length",mx.remoting.RecordSet.prototype = new Object().__get__length,function()
   {
   }
   ));
   §§push(ASSetPropFlags(mx.remoting.RecordSet.prototype,null,1));
}
§§pop();
