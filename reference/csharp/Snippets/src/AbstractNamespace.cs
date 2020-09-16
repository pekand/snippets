using System;
using System.Collections.Generic;
using System.Text;

namespace Snippets.AbstractNamespace
{

    abstract class Shape
    {
        public abstract int GetArea();
    }

    class Square : Shape
    {

        public override int GetArea()
        {
            return 0;
        }
    }

    class App
    {

        public static void Run()
        {
            Console.WriteLine("-Abstract");

            AbstractNamespace.Square square = new AbstractNamespace.Square();
            int area = square.GetArea();
            Console.WriteLine("square area = " + area);
        }
    }

}
