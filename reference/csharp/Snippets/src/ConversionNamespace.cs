using System;

namespace Snippets.ConversionNamespace
{
    class App
    {
        public readonly struct Digit
        {
            private readonly byte digit;

            public Digit(byte digit)
            {
                this.digit = digit;
            }

            public static implicit operator byte(Digit d)
            {
                return d.digit;
            }

            public static explicit operator Digit(byte b)
            {
                return new Digit(b);
            }

            public override string ToString()
            {
                return digit.ToString();
            }
        }

        public static void Run()
        {
            Console.WriteLine("-Conversion");

            var d = new Digit(7);

            byte number = d;
            Console.WriteLine(number);  // output: 7

            Digit digit = (Digit)number; // onli explicit conversion allowd
            Console.WriteLine(digit);
        }
    }
}
