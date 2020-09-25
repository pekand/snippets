using System;
using System.Collections.Generic;
using System.Text;

namespace Snippets.AbstractNamespace
{

    abstract class Shape // class can by abstract without abstract method
    {
        public abstract int GetArea();
    }

    class Square : Shape
    {

        public override int GetArea() // must have same access level
        {
            return 0;
        }
    }

    class App
    {

        public static void Run()
        {
            Console.WriteLine("\n====Abstract====\n");

            Square square = new Square();
            int area = square.GetArea();
            Console.WriteLine("square area = " + area);
        }
    }

}
