using System;

namespace Snippets.ClassOperatorsNamespace
{
    class App
    {
        public readonly struct Fraction
        {
            private readonly int num;
            private readonly int den;

            private readonly int[] arr;

            public Fraction(int numerator = 0, int denominator = 1)
            {
                arr = new int[100];

                if (denominator == 0)
                {
                    throw new ArgumentException("Denominator cannot be zero.", nameof(denominator));
                }
                num = numerator;
                den = denominator;
            }

            public static Fraction operator !(Fraction a)
            {
                return new Fraction();
            }

            public static Fraction operator ~(Fraction a)
            {
                return new Fraction();
            }
            public static Fraction operator ++(Fraction a)
            {
                return new Fraction();
            }

            public static Fraction operator --(Fraction a)
            {
                return new Fraction();
            }

            public static bool operator true(Fraction a)
            {
                return true;
            }

            public static bool operator false(Fraction a)
            {
                return false;
            }

            public static bool operator ==(Fraction a, Fraction b) // mus by in pair with !=
            {
                return true;
            }

            public static bool operator !=(Fraction a, Fraction b)
            {
                return false;
            }

            public override bool Equals(object other) // check if other fraction is eqial with this (required for == operator)
            {
                if (ReferenceEquals(null, other)) return false;
                if (ReferenceEquals(this, other)) return true;
                if (other.GetType() != this.GetType()) return false;

                Fraction otherFraction = (Fraction)other;

                return this.num == otherFraction.num && this.den == otherFraction.den;
            }

            public override int GetHashCode() // generate object hash (required for == operator)
            {
                var mystring = this.num.ToString()+" "+this.den.ToString();
                return mystring.GetHashCode();
            }

            public static bool operator <(Fraction a, Fraction b) // mus by in pair with <
            {
                return false;
            }

            public static bool operator >(Fraction a, Fraction b) 
            {
                return false;
            }

            public static bool operator <=(Fraction a, Fraction b) // mus by in pair with >=
            {
                return false;
            }

            public static bool operator >=(Fraction a, Fraction b)
            {
                return false;
            }

            public static Fraction operator %(Fraction a, Fraction b)
            {
                return new Fraction();
            }

            public static Fraction operator &(Fraction a, Fraction b)
            {
                return new Fraction();
            }

            public static Fraction operator |(Fraction a, Fraction b)
            {
                return new Fraction();
            }

            public static Fraction operator ^(Fraction a, Fraction b)
            {
                return new Fraction();
            }

            public static Fraction operator <<(Fraction a, int n)
            {
                return new Fraction();
            }

            public static Fraction operator >>(Fraction a, int n)
            {
                return new Fraction();
            }


            public static Fraction operator +(Fraction a) 
            {
                return a;
            }

            public static Fraction operator -(Fraction a) 
            { 
                return new Fraction(-a.num, a.den); 
            }

            public static Fraction operator +(Fraction a, Fraction b)
            {
                return new Fraction(a.num * b.den + b.num * a.den, a.den * b.den);
            }

            public static Fraction operator -(Fraction a, Fraction b) 
            {
                return a + (-b);
            }

            public static Fraction operator *(Fraction a, Fraction b)
            {
                return new Fraction(a.num * b.num, a.den * b.den);
            }

            public static Fraction operator /(Fraction a, Fraction b)
            {
                if (b.num == 0)
                {
                    throw new DivideByZeroException();
                }
                return new Fraction(a.num * b.den, a.den * b.num);
            }

            public static implicit operator float(Fraction a) {
                return (float)a.num / (float)a.den ;
            }

            public static explicit operator decimal(Fraction a)
            {
                return (decimal)a.num / (decimal)a.den;
            }

            public int this[int i] // indexer [] operator overloading
            {
                get { return arr[i]; }
                set { arr[i] = value; }
            }

            public override string ToString()
            {
                return $"{num} / {den}";
            }
        }

        public static void Run()
        {
            Console.WriteLine("\n===Class operators===\n");

            var a = new Fraction(5, 4);
            var b = new Fraction(1, 2);
            Console.WriteLine(a.ToString());
            Console.WriteLine(!a);
            Console.WriteLine(-a);   
            Console.WriteLine(a + b);  
            Console.WriteLine(a - b);  
            Console.WriteLine(a * b); 
            Console.WriteLine(a / b);

            float f = a; // implicit converion
            Console.WriteLine(f);

            decimal d = (decimal)a; // explicit converion
            Console.WriteLine(d);

            Console.WriteLine(a[0]); // indexer [] operator overloading
        }
    }
}
