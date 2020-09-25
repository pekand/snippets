using System;

namespace Snippets.RefNamespace
{
    class Class1
    {
        public void Method1(ref int param) // parameter as reference
        {
            param = param + 44;
        }
        public void Method2(out int param) // only output parameter from method (like return)
        {
            param = 1;
            param = param + 44;
        }

        public ref int Method3(ref int param) // return ref
        {
            param += 1;
            return ref param;
        }

    }

    class App
    {

        public static void Run()
        {
            Console.WriteLine("-Ref");

            Class1 obj = new Class1();

            int i = 1;
            obj.Method1(ref i);

            Console.WriteLine(i);

            obj.Method2(out i);

            Console.WriteLine(i);

            i = obj.Method3(ref i);

            Console.WriteLine(i);

            ref int a = ref i;
            
            a += 1;

            Console.WriteLine(a);

        }
    }
}
