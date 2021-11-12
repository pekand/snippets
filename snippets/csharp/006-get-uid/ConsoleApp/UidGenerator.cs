using System;
using System.Text;
using System.Linq;
using System.Security.Cryptography;
using System.Collections.Generic;

namespace ConsoleApp
{
    class UidGenerator
    {
        private String StringToSha256Hash(string value)
        {
            StringBuilder Sb = new StringBuilder();

            using (var hash = SHA256.Create())
            {
                Encoding enc = Encoding.UTF8;
                Byte[] result = hash.ComputeHash(enc.GetBytes(value));

                foreach (Byte b in result)
                    Sb.Append(b.ToString("x2"));
            }

            return Sb.ToString();
        }
        private string GetTime()
        {
            return DateTimeOffset.Now.ToUnixTimeSeconds().ToString();
        }

        private string RandomString(int length)
        {
            Random random = new Random();
            const string chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            return new string(Enumerable.Repeat(chars, length)
              .Select(s => s[random.Next(s.Length)]).ToArray());
        }

        public Uid Generate()
        {
            return new Uid("UID" + StringToSha256Hash(
                 this.GetTime() + this.RandomString(64)
            ));
        }
    }
}
