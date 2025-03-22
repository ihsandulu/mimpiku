if(!_global.mx)
{
   _global.mx = new Object();
}
§§pop();
if(!_global.mx.skins)
{
   _global.mx.skins = new Object();
}
§§pop();
if(!mx.skins.CustomBorder)
{
   mx.skins.CustomBorder.prototype = new mx.skins.Border().__get__width = function()
   {
      return this.__width;
   };
   mx.skins.CustomBorder.prototype = new mx.skins.Border().__get__height = function()
   {
      return this.__height;
   };
   mx.skins.CustomBorder.prototype = new mx.skins.Border().init = function(Void)
   {
      super.init();
   };
   mx.skins.CustomBorder.prototype = new mx.skins.Border().createChildren = function(Void)
   {
   };
   mx.skins.CustomBorder.prototype = new mx.skins.Border().draw = function(Void)
   {
      if(this.l_mc == undefined)
      {
         var _loc2_ = this.setSkin(mx.skins.CustomBorder.tagL,this.leftSkin);
         if(this.horizontal)
         {
            this.minHeight = this.l_mc._height;
            this.minWidth = this.l_mc._width;
         }
         else
         {
            this.minHeight = this.l_mc._height;
            this.minWidth = this.l_mc._width;
         }
      }
      if(this.m_mc == undefined)
      {
         this.setSkin(mx.skins.CustomBorder.tagM,this.middleSkin);
         if(this.horizontal)
         {
            this.minHeight = this.m_mc._height;
            this.minWidth = this.minWidth + this.m_mc._width;
         }
         else
         {
            this.minHeight = this.minHeight + this.m_mc._height;
            this.minWidth = this.m_mc._width;
         }
      }
      if(this.r_mc == undefined)
      {
         this.setSkin(mx.skins.CustomBorder.tagR,this.rightSkin);
         if(this.horizontal)
         {
            this.minHeight = this.r_mc._height;
            this.minWidth = this.minWidth + this.r_mc._width;
         }
         else
         {
            this.minHeight = this.minHeight + this.r_mc._height;
            this.minWidth = this.r_mc._width;
         }
      }
      this.size();
   };
   mx.skins.CustomBorder.prototype = new mx.skins.Border().size = function(Void)
   {
      this.l_mc.move(0,0);
      if(this.horizontal)
      {
         this.r_mc.move(this.__get__width() - this.r_mc.width,0);
         this.m_mc.move(this.l_mc.width,0);
         this.m_mc.setSize(this.r_mc.x - this.m_mc.x,this.m_mc.height);
      }
      else
      {
         this.r_mc.move(0,this.__get__height() - this.r_mc.height,0);
         this.m_mc.move(0,this.l_mc.height);
         this.m_mc.setSize(this.m_mc.width,this.r_mc.y - this.m_mc.y);
      }
   };
   mx.skins.CustomBorder = function()
   {
      super();
   }.symbolName = "CustomBorder";
   mx.skins.CustomBorder = function()
   {
      super();
   }.symbolOwner = mx.skins.CustomBorder;
   mx.skins.CustomBorder = function()
   {
      super();
   }.version = "2.0.2.123";
   mx.skins.CustomBorder.prototype = new mx.skins.Border().className = "CustomBorder";
   mx.skins.CustomBorder = function()
   {
      super();
   }.tagL = 0;
   mx.skins.CustomBorder = function()
   {
      super();
   }.tagM = 1;
   mx.skins.CustomBorder = function()
   {
      super();
   }.tagR = 2;
   mx.skins.CustomBorder.prototype = new mx.skins.Border().idNames = new Array("l_mc","m_mc","r_mc");
   mx.skins.CustomBorder.prototype = new mx.skins.Border().leftSkin = "F3PieceLeft";
   mx.skins.CustomBorder.prototype = new mx.skins.Border().middleSkin = "F3PieceMiddle";
   mx.skins.CustomBorder.prototype = new mx.skins.Border().rightSkin = "F3PieceRight";
   mx.skins.CustomBorder.prototype = new mx.skins.Border().horizontal = true;
   §§push((mx.skins.CustomBorder.prototype = new mx.skins.Border()).addProperty("height",mx.skins.CustomBorder.prototype = new mx.skins.Border().__get__height,function()
   {
   }
   ));
   §§push((mx.skins.CustomBorder.prototype = new mx.skins.Border()).addProperty("width",mx.skins.CustomBorder.prototype = new mx.skins.Border().__get__width,function()
   {
   }
   ));
   §§push(ASSetPropFlags(mx.skins.CustomBorder.prototype,null,1));
}
§§pop();
