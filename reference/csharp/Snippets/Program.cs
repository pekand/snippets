using System;
using System.Collections;
using System.Collections.Generic;

namespace Snippets
{
    class Program
    {
        static void Main(string[] args)
        {
            foreach (string arg in args) {
                Console.WriteLine(arg);
            }

            DataNamespace.App.Run();
            ArrayNamespace.App.Run();
            ConstNamespace.App.Run();
            IfNamespace.App.Run();
            GotoNamespace.App.Run();
            SwitchNamespace.App.Run();
            DoWhileNamespace.App.Run();
            WhileNamespace.App.Run();
            ForNamespace.App.Run();
            ForEachNamespace.App.Run();
            TryCatchNamespace.App.Run();
            SizeofNamespace.App.Run();
            TypeofNamespace.App.Run();
            IsOperatorNamespace.App.Run();
            UsingNamespace.App.Run();
            NestedNamespace.App.Run();
            FunctionNamespace.App.Run();
            StaticClassNamespace.App.Run();
            EnumNamespace.App.Run();
            StructNamespace.App.Run();
            ClassNamespace.App.Run();
            ClassOperatorsNamespace.App.Run();
            BaseClassNamespace.App.Run();
            AbstractNamespace.App.Run();
            VirtualNamespace.App.Run();
            PropertiesNamespace.App.Run();
            CheckedNamespace.App.Run();
            EventNamespace.App.Run();
            DelegateNamespace.App.Run();
            ConversionNamespace.App.Run();
            ExternNamespace.App.Run();
            UnsafeNamespace.App.Run();
            ThreadNamespace.App.Run();
            Thread2Namespace.App.Run();
            RefNamespace.App.Run();
            ReadonlyNamespace.App.Run();
            ParamsNamespace.App.Run();
            UncheckedNamespace.App.Run();
            StackallocNamespace.App.Run();

            Console.WriteLine("Done");
        }
    }
}
