using System;

namespace Snippets.UnsafeNamespace
{
    class App
    {
        class Point
        {
            public int x = 0;
            public int y = 0;
        }

        // project must have Build\"Allow unsafe code" checkbox enabled
        unsafe private static void ModifyFixedStorage()
        {
            Point pt = new Point();

            fixed (int* px = &pt.x) // prevent garbage collector destroy object
            {
                *px = 2;
            }

            fixed (int* py = &pt.y)
            {
                
                *py = 3;
            }

            Console.WriteLine("{0} {0}", pt.x, pt.y);
        }

        public static void Run()
        {
            Console.WriteLine("-Unsafe");

            ModifyFixedStorage();
        }
    }
}
