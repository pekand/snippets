using System;

namespace Snippets.DelegateNamespace
{
    class Class1
    {

        public delegate void MessageDelegate(string message);


        public virtual void Action(MessageDelegate callback)
        {
            callback("Message1");
        }

    }

    class App
    {
        public static void ShowMessage(string message)
        {
            Console.WriteLine(message);
        }

        public static void Run()
        {
            Console.WriteLine("-Delegate");

            Class1 obj = new Class1();
            obj.Action(ShowMessage);
        }
    }
}
