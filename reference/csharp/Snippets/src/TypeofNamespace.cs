using System;

namespace Snippets.TypeofNamespace
{


    class App
    {

        public static void Run()
        {
            Console.WriteLine("-Typeof");

            Console.WriteLine("{0}", typeof(sbyte));
            Console.WriteLine("{0}", typeof(byte));
            Console.WriteLine("{0}", typeof(short));
            Console.WriteLine("{0}", typeof(ushort));
            Console.WriteLine("{0}", typeof(int));
            Console.WriteLine("{0}", typeof(uint));
            Console.WriteLine("{0}", typeof(long));
            Console.WriteLine("{0}", typeof(ulong));
            Console.WriteLine("{0}", typeof(char));
            Console.WriteLine("{0}", typeof(float));
            Console.WriteLine("{0}", typeof(double));
            Console.WriteLine("{0}", typeof(decimal));
            Console.WriteLine("{0}", typeof(bool));

            ClassNamespace.BaseClass obj = new ClassNamespace.BaseClass();
            Console.WriteLine(obj.GetType() == typeof(ClassNamespace.BaseClass));
        }
    }
}
