using System;
using System.Collections.Generic;
using System.Text;

namespace Snippets.StructNamespace
{
    public readonly struct Coords // readonly struct prevent modification in methods
    {
        public Coords(double x, double y)
        {
            X = x;
            Y = y;
        }

        public readonly double Sum() // readonly prevent data modification from method
        {
            return X + Y;
        }

        public double X { get; }
        public double Y { get; }

        public override string ToString() => $"({X}, {Y})";
    }

    public ref struct CustomRef // ref structure
    {
        public bool IsValid;
    }

    class App
    {

        public static void Run()
        {
            Console.WriteLine("-Struct");

            StructNamespace.Coords position = new StructNamespace.Coords(1, 2);

            Console.WriteLine(position.Sum());
        }
    }
}