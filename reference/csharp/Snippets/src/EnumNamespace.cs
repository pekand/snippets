using System;
using System.Collections.Generic;
using System.Text;

namespace Snippets.EnumNamespace
{
    public enum Month
    {
        January,
        February,
        March,
        April,
        May,
        June,
        July,
        August,
        September,
        October,
        November,
        December
    }

    public enum Days
    {
        None = 0b_0000_0000,
        Monday = 0b_0000_0001,
        Tuesday = 0b_0000_0010,
        Wednesday = 0b_0000_0100,
        Thursday = 0b_0000_1000,
        Friday = 0b_0001_0000,
        Saturday = 0b_0010_0000,
        Sunday = 0b_0100_0000,
        Weekend = Saturday | Sunday
    }

    class App
    {

        public static void Run()
        {
            Console.WriteLine("-Enum");

            EnumNamespace.Month month = new EnumNamespace.Month();
            month = EnumNamespace.Month.February;
            Console.WriteLine(month);
            Console.WriteLine((int)EnumNamespace.Month.August);
            month = (EnumNamespace.Month)11;
            Console.WriteLine(month);



            EnumNamespace.Days days = new EnumNamespace.Days();
            days = EnumNamespace.Days.Monday | EnumNamespace.Days.Wednesday | EnumNamespace.Days.Friday;

            if ((days & EnumNamespace.Days.Monday) == EnumNamespace.Days.Monday)
            {
                Console.WriteLine("Monday is set");
            }

            Console.WriteLine(days);
        }
    }
}
