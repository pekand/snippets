using System;

namespace Snippets.ParamsNamespace
{
    class Class1
    {
        public void Method1(params int[] list)
        {
            for (int i = 0; i < list.Length; i++)
            {
                Console.WriteLine(list[i] + " ");
            }
        }

        public void Method2(params object[] list)
        {
            for (int i = 0; i < list.Length; i++)
            {
                Console.WriteLine(list[i] + " ");
            }
        }
    }

    class App
    {
        public static void Run()
        {
            Console.WriteLine("-Params");

            Class1 obj = new Class1();
            obj.Method1(1, 2, 3, 4);


            int[] p = { 5, 6, 7, 8, 9 };
            obj.Method1(p);

            object[] p2 = { 10, 11, "7", "8", "9" };
            obj.Method2(p2);
        }
    }
}
