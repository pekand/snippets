using System;

namespace Snippets.UncheckedNamespace
{
    class Class1
    {
        public void Method1()
        {
            const int ConstantMax = int.MaxValue - 10;

            
            unchecked
            {
                int i = ConstantMax + 23;
                Console.WriteLine(i);
            }

            int i2 = unchecked(ConstantMax + 23);
            Console.WriteLine(i2);


            checked
            {
                unchecked
                {
                    int i3 = ConstantMax + 23;
                    Console.WriteLine(i3);
                }
            }

            checked
            {
                int j = ConstantMax + 10;
                Console.WriteLine(j);
            }

            int j2 = checked(ConstantMax + 10);
            Console.WriteLine(j2);
        }
    }

    class App
    {

        public static void Run()
        {
            Console.WriteLine("-Unchecked");

            Class1 obj = new Class1();
            obj.Method1();
        }
    }
}
