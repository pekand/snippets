using System;

namespace Snippets.CheckedNamespace
{
    class App
    {

        public static void Run()
        {
            Console.WriteLine("-Checked");

            int maxIntValue = 2147483647;

            try
            {
                int z = checked(maxIntValue + 10); // throw exception when Overflow
            }
            catch (System.OverflowException ex)
            {
                Console.WriteLine("OverflowException:  " + ex.ToString());
            }
        }
    }
}
