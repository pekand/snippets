using System;

namespace Snippets.SizeofNamespace
{


    class App
    {

        public static void Run()
        {
            Console.WriteLine("-Sizeof");

            Console.WriteLine("sbyte-{0:D}", sizeof(sbyte));
            Console.WriteLine("byte-{0:D}", sizeof(byte));
            Console.WriteLine("short-{0:D}", sizeof(short));
            Console.WriteLine("ushort-{0:D}", sizeof(ushort));
            Console.WriteLine("int-{0:D}", sizeof(int));
            Console.WriteLine("uint-{0:D}", sizeof(uint));
            Console.WriteLine("long-{0:D}", sizeof(long));
            Console.WriteLine("ulong-{0:D}", sizeof(ulong));
            Console.WriteLine("char-{0:D}", sizeof(char));
            Console.WriteLine("float-{0:D}", sizeof(float));
            Console.WriteLine("double-{0:D}", sizeof(double));
            Console.WriteLine("decimal-{0:D}", sizeof(decimal));
            Console.WriteLine("bool-{0:D}", sizeof(bool));
        }
    }
}
