using System;

namespace Snippets.ReadonlyNamespace
{
     class Point {
        public readonly int x = 0;
        public readonly int y = 0 ;

        public Point(int x, int y) { // modification is allowed in constructor
            this.x = x;
            this.y = y;
        }

        public void Print() {
            Console.WriteLine("[{0} {1}]", this.x, this.y);
        }
    }

    class App
    {

        public static void Run()
        {
            Console.WriteLine("\n====Readonly====\n");

            Point p = new Point(1, 2);
            p.Print();
            
        }
    }
}
