class mx.remoting.RecordSetIterator
{
   static var version = "1.2.0.124";
   function RecordSetIterator(rec)
   {
      this._recordSet = rec;
      this._cursor = 0;
   }
   function hasNext()
   {
      return this._cursor < this._recordSet.getLength();
   }
   function next()
   {
      this._cursor = this._cursor + 1;
      return this._recordSet.getItemAt(this._cursor);
   }
}
