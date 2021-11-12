using System;
using System.Collections.Generic;
using System.Text;
using System.Text.RegularExpressions;

namespace ConsoleApp
{
    class Uid
    {
        string uid = null;

        public Uid(string uid) {
            if (!this.isValid(uid)) {
                throw new Exception("Uid don't have right format");
            }

            this.uid = uid;
        }

        public bool isValid(string uid) {
            var regex = @"^UID[A-Fa-f0-9]{64}$";
            var match = Regex.Match(uid, regex);

            if (!match.Success)
            {
                return false;
            }

            return true;
        }


        public override string ToString()
        {
            return this.uid;
        }

    }
}
