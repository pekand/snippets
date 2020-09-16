using System;
using System.Collections.Generic;
using System.Text;

namespace Snippets.DataNamespace
{
    class App
    {

        public static void Run()
        {
            Console.WriteLine("-DATA");

            Snippets.ClassNamespace.Class1 obj1 = null; // null //xxx
            int? nValue = null; // nullable value

            Console.WriteLine("{0} {0}", obj1, nValue);

            bool check = false; // true, false

            Console.WriteLine("{0}", check);

            sbyte d1 = 0;  // -128 to 127
            byte d2 = 0;   // 0 to 255
            short d3 = 0;  // -32,768 to 32,767
            ushort d4 = 0; // 0 to 65,535
            int d5 = 0;    // -2,147,483,648 to 2,147,483,647
            uint d6 = 0;   // 0 to 4,294,967,295
            long d7 = 0;   // -9,223,372,036,854,775,808 to 9,223,372,036,854,775,807
            ulong d8 = 0;  // 0 to 18,446,744,073,709,551,615

            Console.WriteLine("{0:D} {0:D} {0:D} {0:D} {0:D} {0:D} {0:D} {0:D}", d1, d2, d3, d4, d5, d6, d7, d8);

            float f1 = 0.1234f;  // ±1.5 x 10−45 to ±3.4 x 1038
            float f1_1 = 0.1e10f;
            double f2 = 0.0d; // ±5.0 × 10−324 to ±1.7 × 10308
            decimal f3 = 0.0m; // ±1.0 x 10-28 to ±7.9228 x 1028

            Console.WriteLine("{0:0.00} {0} {0} {0}", f1, f1_1, f2, f3);

            char ch1 = 'a';
            char ch2 = '\u006A'; // Unicode escape sequence (equal to \u06A, \u6A)
            char ch3 = '\x006A'; // hexadecimal escape sequence (equal to \x06A, \x6A)

            Console.WriteLine("{0} {0} {0}", ch1, ch2, ch3);

            string s1 = "string";
            string s2 = @"string"; // Verbatim string literals

            Console.WriteLine("", s1, s2);
        }
    }
}
