if(!_global.mx)
{
   _global.mx = new Object();
}
§§pop();
if(!_global.mx.controls)
{
   _global.mx.controls = new Object();
}
§§pop();
if(!mx.controls.TextArea)
{
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__maxChars = function()
   {
      return this.label.maxChars;
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__set__maxChars = function(x)
   {
      this.label.maxChars = x;
      return this.__get__maxChars();
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__length = function()
   {
      return this.label.length;
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__restrict = function()
   {
      return this.label.restrict;
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__set__restrict = function(s)
   {
      this.label.restrict = s != ""?s:null;
      return this.__get__restrict();
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__wordWrap = function()
   {
      return this.label.wordWrap;
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__set__wordWrap = function(s)
   {
      this.label.wordWrap = s;
      this.invalidate();
      return this.__get__wordWrap();
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__editable = function()
   {
      return this.__editable;
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__set__editable = function(x)
   {
      this.__editable = x;
      this.label.type = !x?"dynamic":"input";
      return this.__get__editable();
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__password = function()
   {
      return this.label.password;
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__set__password = function(s)
   {
      this.label.password = s;
      return this.__get__password();
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__html = function()
   {
      return this.getHtml();
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__set__html = function(value)
   {
      this.setHtml(value);
      return this.__get__html();
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().getHtml = function()
   {
      return this.label.html;
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().setHtml = function(value)
   {
      if(value != this.label.html)
      {
         this.label.html = value;
      }
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__text = function()
   {
      return this.getText();
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__set__text = function(t)
   {
      this.setText(t);
      return this.__get__text();
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().getText = function()
   {
      if(this.initializing)
      {
         return this.initText;
      }
      var _loc2_ = this.label;
      if(_loc2_.html == true)
      {
         return _loc2_.htmlText;
      }
      return _loc2_.text;
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().setText = function(t)
   {
      if(this.initializing)
      {
         this.initText = t;
      }
      else
      {
         var _loc2_ = this.label;
         if(_loc2_.html == true)
         {
            _loc2_.htmlText = t;
         }
         else
         {
            _loc2_.text = t;
         }
         this.invalidate();
      }
      this.dispatchValueChangedEvent(t);
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__hPosition = function()
   {
      return this.getHPosition();
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__set__hPosition = function(pos)
   {
      this.setHPosition(pos);
      this.label.hscroll = pos;
      this.label.background = false;
      return this.__get__hPosition();
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__vPosition = function()
   {
      return this.getVPosition();
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__set__vPosition = function(pos)
   {
      this.setVPosition(pos);
      this.label.scroll = pos + 1;
      this.label.background = false;
      return this.__get__vPosition();
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__maxVPosition = function()
   {
      var _loc2_ = this.label.maxscroll - 1;
      return _loc2_ != undefined?_loc2_:0;
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__maxHPosition = function()
   {
      var _loc2_ = this.label.maxhscroll;
      return _loc2_ != undefined?_loc2_:0;
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().init = function(Void)
   {
      super.init();
      this.label.styleName = this;
      this._color = mx.core.UIObject.textColorList;
      this.focusTextField = this.label;
      this.label.owner = this;
      this.label.onSetFocus = function(x)
      {
         this._parent.onSetFocus(x);
      };
      this.label.onKillFocus = function(x)
      {
         this._parent.onKillFocus(x);
      };
      this.label.drawFocus = function(b)
      {
         this._parent.drawFocus(b);
      };
      this.label.onChanged = function()
      {
         this.owner.adjustScrollBars();
         this.owner.dispatchEvent({type:"change"});
         this.owner.dispatchValueChangedEvent(this.owner.text);
      };
      this.label.onScroller = function()
      {
         this.owner.hPosition = this.hscroll;
         this.owner.vPosition = this.scroll - 1;
      };
      if(this.__get__text() == undefined)
      {
         this.__set__text("");
      }
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().createChildren = function(Void)
   {
      super.createChildren();
      this.label.autoSize = "none";
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().layoutContent = function(x, y, totalW, totalH, displayW, displayH)
   {
      var _loc2_ = this.label;
      if(this.tfx != x || this.tfy != y || this.tfw != displayW || this.tfh != displayH)
      {
         this.tfx = x;
         this.tfy = y;
         this.tfw = displayW;
         this.tfh = displayH;
         _loc2_.move(this.tfx,this.tfy);
         _loc2_.setSize(this.tfw,this.tfh);
         this.doLater(this,"adjustScrollBars");
      }
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().scrollChanged = function(Void)
   {
      var _loc2_ = Selection;
      if(_loc2_.lastBeginIndex != undefined)
      {
         this.restoreSelection();
      }
      this.label.background = false;
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().onScroll = function(docObj)
   {
      var _loc3_ = this.label;
      super.onScroll(docObj);
      _loc3_.hscroll = this.__get__hPosition() + 0;
      _loc3_.scroll = this.__get__vPosition() + 1;
      this._vpos = _loc3_.scroll;
      this._hpos = _loc3_.hscroll;
      _loc3_.background = false;
      if(this.hookedV != true)
      {
         this.vScroller.addEventListener("scrollChanged",this);
         this.hookedV = true;
      }
      if(this.hookedH != true)
      {
         this.hScroller.addEventListener("scrollChanged",this);
         this.hookedH = true;
      }
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().size = function(Void)
   {
      var _loc3_ = this.getViewMetrics();
      var _loc7_ = _loc3_.left + _loc3_.right;
      var _loc4_ = _loc3_.top + _loc3_.bottom;
      var _loc6_ = _loc3_.left;
      var _loc5_ = _loc3_.top;
      this.tfx = _loc6_;
      this.tfy = _loc5_;
      this.tfw = this.__get__width() - _loc7_;
      this.tfh = this.__get__height() - _loc4_;
      super.size();
      this.label.move(this.tfx,this.tfy);
      this.label.setSize(this.tfw,this.tfh);
      if(this.__get__height() <= 40)
      {
         this.hScrollPolicy = "off";
         this.vScrollPolicy = "off";
      }
      this.doLater(this,"adjustScrollBars");
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().setEnabled = function(enable)
   {
      this.vScroller.enabled = enable;
      this.hScroller.enabled = enable;
      this.label.type = !(this.__get__editable() == false || enable == false)?"input":"dynamic";
      this.label.selectable = enable;
      var _loc3_ = this.getStyle(!enable?"disabledColor":"color");
      if(_loc3_ == undefined)
      {
         _loc3_ = !enable?8947848:0;
      }
      this.setColor(_loc3_);
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().setColor = function(col)
   {
      this.label.textColor = col;
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().setFocus = function(Void)
   {
      Selection.setFocus(this.label);
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().onSetFocus = function(x)
   {
      var f = Selection.getFocus();
      var o = eval(f);
      if(o != this.label)
      {
         Selection.setFocus(this.label);
         return undefined;
      }
      this.getFocusManager().defaultPushButtonEnabled = false;
      this.addEventListener("keyDown",this);
      super.onSetFocus(x);
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().onKillFocus = function(x)
   {
      this.getFocusManager().defaultPushButtonEnabled = true;
      this.removeEventListener("keyDown",this);
      super.onKillFocus(x);
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().restoreSelection = function(x)
   {
      var _loc2_ = Selection;
      Selection.setSelection(_loc2_.lastBeginIndex,_loc2_.lastEndIndex);
      this.label.scroll = this._vpos;
      this.label.hscroll = this._hpos;
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().getLineOffsets = function(Void)
   {
      var _loc16_ = this._getTextFormat();
      var _loc18_ = _loc16_.getTextExtent2(this.label.text);
      var _loc5_ = _root._getTextExtent;
      _loc5_.setNewTextFormat(_loc16_);
      var _loc14_ = this.label.wordWrap;
      var _loc9_ = 0;
      var _loc7_ = this.label._width - 2 - 2;
      var _loc12_ = new Array();
      var _loc17_ = new String(this.label.text);
      var _loc15_ = _loc17_.split("\r");
      var _loc11_ = 0;
      while(_loc11_ < _loc15_.length)
      {
         _loc12_.push(_loc9_);
         var _loc4_ = _loc15_[_loc11_];
         _loc5_.text = _loc4_;
         var _loc13_ = Math.ceil(_loc5_.textWidth / _loc7_);
         var _loc10_ = Math.floor(_loc4_.length / _loc13_);
         var _loc3_ = undefined;
         while(_loc14_ && _loc5_.textWidth > _loc7_)
         {
            _loc3_ = _loc4_.indexOf(" ",_loc10_);
            var _loc6_ = undefined;
            if(_loc3_ == -1)
            {
               _loc3_ = _loc4_.lastIndexOf(" ");
               if(_loc3_ == -1)
               {
                  _loc3_ = _loc10_;
               }
            }
            _loc6_ = _loc4_.substr(0,_loc3_);
            _loc5_.text = _loc6_;
            if(_loc5_.textWidth > _loc7_)
            {
               while(_loc5_.textWidth > _loc7_)
               {
                  var _loc8_ = _loc3_;
                  _loc3_ = _loc4_.lastIndexOf(" ",_loc3_ - 1);
                  if(_loc3_ == -1)
                  {
                     _loc3_ = _loc8_ - 1;
                  }
                  _loc6_ = _loc4_.substr(0,_loc3_);
                  _loc5_.text = _loc6_;
               }
            }
            else if(_loc5_.textWidth < _loc7_)
            {
               _loc8_ = _loc3_;
               while(_loc5_.textWidth < _loc7_)
               {
                  _loc8_ = _loc3_;
                  _loc3_ = _loc4_.indexOf(" ",_loc3_ + 1);
                  if(_loc3_ == -1)
                  {
                     if(_loc4_.indexOf(" ",0) != -1)
                     {
                        break;
                     }
                     _loc3_ = _loc8_ + 1;
                  }
                  _loc6_ = _loc4_.substr(0,_loc3_);
                  _loc5_.text = _loc6_;
               }
               _loc3_ = _loc8_;
            }
            _loc9_ = _loc9_ + _loc3_;
            _loc12_.push(_loc9_ + 1);
            _loc4_ = _loc4_.substr(_loc3_);
            if(_loc4_.charAt(0) == " ")
            {
               _loc4_ = _loc4_.substr(1,_loc4_.length - 1);
               _loc9_ = _loc9_ + 1;
            }
            _loc5_.text = _loc4_;
         }
         _loc9_ = _loc9_ + (_loc4_.length + 1);
         _loc11_ = _loc11_ + 1;
      }
      return _loc12_;
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().keyDown = function(e)
   {
      var _loc5_ = e.code;
      if(_loc5_ == 34)
      {
         var _loc6_ = this.label.bottomScroll - this.label.scroll + 1;
         var _loc3_ = this.getLineOffsets();
         var _loc2_ = Math.min(this.label.bottomScroll + 1,this.label.maxscroll);
         if(_loc2_ == this.label.maxscroll)
         {
            var _loc4_ = this.label.length;
            Selection.setSelection(_loc4_,_loc4_);
         }
         else
         {
            this.label.scroll = _loc2_;
            Selection.setSelection(_loc3_[_loc2_ - 1],_loc3_[_loc2_ - 1]);
         }
      }
      else if(_loc5_ == 33)
      {
         _loc6_ = this.label.bottomScroll - this.label.scroll + 1;
         _loc3_ = this.getLineOffsets();
         _loc2_ = this.label.scroll - 1;
         if(_loc2_ < 1)
         {
            Selection.setSelection(0,0);
         }
         else
         {
            Selection.setSelection(_loc3_[_loc2_ - 1],_loc3_[_loc2_ - 1]);
            this.label.scroll = Math.max(_loc2_ - _loc6_,1);
         }
      }
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().draw = function(Void)
   {
      var _loc2_ = this.label;
      var _loc4_ = this.getText();
      if(this.initializing)
      {
         this.initializing = false;
         delete this.initText;
      }
      var _loc3_ = this._getTextFormat();
      _loc2_.embedFonts = _loc3_.embedFonts == true;
      if(_loc3_ != undefined)
      {
         _loc2_.setTextFormat(_loc3_);
         _loc2_.setNewTextFormat(_loc3_);
      }
      _loc2_.multiline = true;
      _loc2_.wordWrap = this.__get__wordWrap() == true;
      if(_loc2_.html == true)
      {
         _loc2_.setTextFormat(_loc3_);
         _loc2_.htmlText = _loc4_;
      }
      else
      {
         _loc2_.text = _loc4_;
      }
      _loc2_.type = this.__get__editable() != true?"dynamic":"input";
      this.size();
      _loc2_.background = false;
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().adjustScrollBars = function()
   {
      var _loc2_ = this.label;
      var _loc4_ = _loc2_.bottomScroll - _loc2_.scroll + 1;
      var _loc3_ = _loc4_ + _loc2_.maxscroll - 1;
      if(_loc3_ < 1)
      {
         _loc3_ = 1;
      }
      var _loc5_ = 0;
      if(_loc2_.textWidth + 5 > _loc2_._width)
      {
         if(!_loc2_.wordWrap)
         {
            _loc5_ = _loc2_._width + _loc2_.maxhscroll;
         }
      }
      else
      {
         _loc2_.hscroll = 0;
         _loc2_.background = false;
      }
      if(_loc2_.height / _loc4_ != Math.round(_loc2_.height / _loc4_))
      {
         _loc3_ = _loc3_ - 1;
      }
      this.setScrollProperties(_loc5_,1,_loc3_,_loc2_.height / _loc4_);
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().setScrollProperties = function(colCount, colWidth, rwCount, rwHeight, hPadding, wPadding)
   {
      super.setScrollProperties(colCount,colWidth,rwCount,rwHeight,hPadding,wPadding);
      if(this.vScroller == undefined)
      {
         this.hookedV = false;
      }
      if(this.hScroller == undefined)
      {
         this.hookedH = false;
      }
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__tabIndex = function()
   {
      return this.label.tabIndex;
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__set__tabIndex = function(w)
   {
      this.label.tabIndex = w;
      return this.__get__tabIndex();
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__set___accProps = function(val)
   {
      this.label._accProps = val;
      return this.__get___accProps();
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__get___accProps = function()
   {
      return this.label._accProps;
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__styleSheet = function()
   {
      return this.label.styleSheet;
   };
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__set__styleSheet = function(v)
   {
      this.label.styleSheet = v;
      return this.__get__styleSheet();
   };
   mx.controls.TextArea = function()
   {
      super();
   }.symbolName = "TextArea";
   mx.controls.TextArea = function()
   {
      super();
   }.symbolOwner = mx.controls.TextArea;
   mx.controls.TextArea = function()
   {
      super();
   }.version = "2.0.2.123";
   mx.controls.TextArea.prototype = new mx.core.ScrollView().className = "TextArea";
   mx.controls.TextArea.prototype = new mx.core.ScrollView().initializing = true;
   mx.controls.TextArea.prototype = new mx.core.ScrollView().clipParameters = {text:1,wordWrap:1,editable:1,maxChars:1,restrict:1,html:1,password:1};
   mx.controls.TextArea = function()
   {
      super();
   }.mergedClipParameters = mx.core.UIObject.mergeClipParameters(mx.controls.TextArea.prototype.clipParameters,mx.core.ScrollView.prototype.clipParameters);
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__vScrollPolicy = "auto";
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__hScrollPolicy = "auto";
   mx.controls.TextArea.prototype = new mx.core.ScrollView().__editable = true;
   §§push((mx.controls.TextArea.prototype = new mx.core.ScrollView()).addProperty("_accProps",mx.controls.TextArea.prototype = new mx.core.ScrollView().__get___accProps,mx.controls.TextArea.prototype = new mx.core.ScrollView().__set___accProps));
   §§push((mx.controls.TextArea.prototype = new mx.core.ScrollView()).addProperty("editable",mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__editable,mx.controls.TextArea.prototype = new mx.core.ScrollView().__set__editable));
   §§push((mx.controls.TextArea.prototype = new mx.core.ScrollView()).addProperty("hPosition",mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__hPosition,mx.controls.TextArea.prototype = new mx.core.ScrollView().__set__hPosition));
   §§push((mx.controls.TextArea.prototype = new mx.core.ScrollView()).addProperty("html",mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__html,mx.controls.TextArea.prototype = new mx.core.ScrollView().__set__html));
   §§push((mx.controls.TextArea.prototype = new mx.core.ScrollView()).addProperty("length",mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__length,function()
   {
   }
   ));
   §§push((mx.controls.TextArea.prototype = new mx.core.ScrollView()).addProperty("maxChars",mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__maxChars,mx.controls.TextArea.prototype = new mx.core.ScrollView().__set__maxChars));
   §§push((mx.controls.TextArea.prototype = new mx.core.ScrollView()).addProperty("maxHPosition",mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__maxHPosition,function()
   {
   }
   ));
   §§push((mx.controls.TextArea.prototype = new mx.core.ScrollView()).addProperty("maxVPosition",mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__maxVPosition,function()
   {
   }
   ));
   §§push((mx.controls.TextArea.prototype = new mx.core.ScrollView()).addProperty("password",mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__password,mx.controls.TextArea.prototype = new mx.core.ScrollView().__set__password));
   §§push((mx.controls.TextArea.prototype = new mx.core.ScrollView()).addProperty("restrict",mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__restrict,mx.controls.TextArea.prototype = new mx.core.ScrollView().__set__restrict));
   §§push((mx.controls.TextArea.prototype = new mx.core.ScrollView()).addProperty("styleSheet",mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__styleSheet,mx.controls.TextArea.prototype = new mx.core.ScrollView().__set__styleSheet));
   §§push((mx.controls.TextArea.prototype = new mx.core.ScrollView()).addProperty("tabIndex",mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__tabIndex,mx.controls.TextArea.prototype = new mx.core.ScrollView().__set__tabIndex));
   §§push((mx.controls.TextArea.prototype = new mx.core.ScrollView()).addProperty("text",mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__text,mx.controls.TextArea.prototype = new mx.core.ScrollView().__set__text));
   §§push((mx.controls.TextArea.prototype = new mx.core.ScrollView()).addProperty("vPosition",mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__vPosition,mx.controls.TextArea.prototype = new mx.core.ScrollView().__set__vPosition));
   §§push((mx.controls.TextArea.prototype = new mx.core.ScrollView()).addProperty("wordWrap",mx.controls.TextArea.prototype = new mx.core.ScrollView().__get__wordWrap,mx.controls.TextArea.prototype = new mx.core.ScrollView().__set__wordWrap));
   §§push(ASSetPropFlags(mx.controls.TextArea.prototype,null,1));
}
§§pop();
