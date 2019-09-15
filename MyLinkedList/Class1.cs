using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace MyLinkedList
{
    public static class LinkedListHelpers
    {
       
        /**
         *  Function to output node frequency in a given Linked List
         * 
         */
        public static void TestNodeCount(LinkedList<char> MyList, string Title)
        {
            if (MyList != null)
            {

                Dictionary<char, int> CountedNodes = new Dictionary<char, int> { };

                LinkedListNode<char> CurrentNode = MyList.First;

                while (CurrentNode != null)
                {
                    if (!CountedNodes.ContainsKey(CurrentNode.Value))
                    {
                        CountedNodes.Add(CurrentNode.Value, 1);
                    }
                    else
                    {
                        CountedNodes[CurrentNode.Value] = CountedNodes[CurrentNode.Value] + 1;
                    }
                    CurrentNode = CurrentNode.Next;
                }
                //Output the count results for each 
                Console.WriteLine("*****LINKED LIST NODE FREQ: " + Title + "****");

                foreach (KeyValuePair<char, int> item in CountedNodes)
                {
                    Console.WriteLine("Node: {0}, Frequency: {1}", item.Key, item.Value);
                }
            }
        }
        /*
         * function to maintain node frequency to a maximum of two in a given linked list
         * 
         */
        public static LinkedList<char> RefineDuplicates(LinkedList<char> MyList)
        {
            Dictionary<char, int> CountedNodes = new Dictionary<char, int> { };

            LinkedListNode<char> CurrentNode = MyList.First;

            int MaxCount = 2;

            while (CurrentNode != null)
            {
                if (!CountedNodes.ContainsKey(CurrentNode.Value))
                {
                    CountedNodes.Add(CurrentNode.Value, 1);
                }
                else if (CountedNodes[CurrentNode.Value] < MaxCount)
                {
                    CountedNodes[CurrentNode.Value] = CountedNodes[CurrentNode.Value] + 1;
                }
                else
                {
                    MyList.Remove(CurrentNode.Value);
                }

                CurrentNode = CurrentNode.Next;
            }
            return MyList;
        }
    }
}
