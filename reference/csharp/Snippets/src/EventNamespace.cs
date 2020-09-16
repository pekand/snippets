using System;

namespace Snippets.EventNamespace
{
    class Class1 {

        public delegate void MessageDelegate(string message);

        public event MessageDelegate AfterAction;

        public virtual void Action()
        {
            this.AfterAction?.Invoke("message1");
        }

    }
    
    class App
    {

        public static void OnActionOccured(string message) {
            Console.WriteLine(message);
        }

        public static void Run()
        {
            Console.WriteLine("-Event");

            Class1 obj = new Class1();
            obj.AfterAction += OnActionOccured;

            obj.Action();

        }
    }
}
