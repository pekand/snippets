using System;
using System.Collections.Generic;
using System.Text;

namespace ConsoleApp
{
    class UidSwap
    {
        private UidStorage storage = null;
        private Dictionary<string, string> uids = new Dictionary<string, string>();

        public UidSwap(UidStorage storage)
        {

        }

        public bool Has(Uid uid)
        {
            return uids.ContainsKey(uid.ToString());
        }

        public bool Add(Uid uid)
        {
            if (this.Has(uid))
            {
                return false;
            }

            this.uids.Add(uid.ToString());
            return true;
        }

        public void AddIfNotExists(Uid uid)
        {
            if (this.Has(uid))
            {
                throw new Exception("UidStorage already has uid with this key");
            }

            this.uids.Add(uid.ToString());
        }

        public Uid Generate()
        {
            Uid uid = null;
            int counter = 100;
            while (true)
            {
                uid = uidGenerator.Generate();

                if (!this.Has(uid))
                {
                    break;
                }

                counter = counter - 1;

                if (counter == 0)
                {
                    throw new Exception("Somethink is wrong. UidStorage can't generate uinq uid after 100x attemps");
                }
            }

            this.Add(uid);

            return uid;
        }
    }
}
