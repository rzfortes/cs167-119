import unittest
import nose
import rednose

from bstree import BinarySearchTree
from bstnode import BinarySearchTreeNode


class BinarySearchTreeTestCase(unittest.TestCase):

    def test_should_have_root_property(self):
        # initialize
        self.tree = BinarySearchTree()
        self.assertTrue(hasattr(self.tree, 'root'))

    def test_should_default_root_to_none(self):
        self.tree = BinarySearchTree()
        self.assertEqual(self.tree.root, None)


class BinarySearchTreeInsertTestCase(unittest.TestCase):

    def setUp(self):
        self.tree = BinarySearchTree()

    def test_first_inserted_value_should_be_root(self):
        # insert a node
        inserted_node = self.tree.insert(1, 'one')
        # inserted node should be root
        self.assertEqual(self.tree.root, inserted_node)

        # insert another node
        new_node = self.tree.insert(2, '2')
        # root should be inserted_root pa rin
        self.assertEqual(self.tree.root, inserted_node)

    def test_should_set_node_properties_properly(self):
        root_two = self.tree.insert(2, 'two')
        self.assertEqual(root_two.parent, None)
        self.assertEqual(root_two.left, None)
        self.assertEqual(root_two.right, None)

        # insert another node
        one = self.tree.insert(1, 'one')
        self.assertEqual(one.parent, root_two)
        self.assertEqual(one.left, None)
        self.assertEqual(one.right, None)

        # root_two left child should be one
        self.assertEqual(root_two.left, one)

        # insert new node
        four = self.tree.insert(4, 'four')
        self.assertEqual(four.parent, root_two)
        self.assertEqual(four.left, None)
        self.assertEqual(four.right, None)

        # root_two right child should be four
        self.assertEqual(root_two.right, four)


class BinarySearchTreeDeleteTestCase(unittest.TestCase):

    def setUp(self):
        self.tree = BinarySearchTree()
        self.seven = self.tree.insert(7, 'seven')
        self.fifteen = self.tree.insert(15, 'fifteen')
        self.eight = self.tree.insert(8, 'eight')
        self.fourteen = self.tree.insert(14, 'fourteen')
        self.nine = self.tree.insert(9, 'nine')

    def test_return_deleted_node(self):
        delete_node = self.tree.delete(8)
        self.assertEqual(delete_node, self.eight)

    def test_set_deleted_node_properties_to_none(self):
        delete_node = self.tree.delete(8)
        self.assertEqual(delete_node.parent, None)
        self.assertEqual(delete_node.left, None)
        self.assertEqual(delete_node.right, None)

    def test_should_replace_deleted_node_with_smallest_value_in_right_subtree(self):
        self.tree.delete(8)

        # in this tree, node "9" should replace the deleted node "8"
        self.assertEqual(self.fifteen.left, self.nine)
        self.assertEqual(self.nine.parent, self.fifteen)
        self.assertEqual(self.nine.left, None)
        self.assertEqual(self.nine.right, self.fourteen)

        # node "9" will then be replaced with node "13"
        self.assertEqual(self.fourteen.left, self.thirteen)
        self.assertEqual(self.thirteen.parent, self.fourteen)
        self.assertEqual(self.thirteen.left, self.ten)
        self.assertEqual(self.thirteen.right, None)

class BinarySearchTreeGetTestCase(unittest.TestCase):

    def setUp(self):
        self.tree = BinarySearchTree()
        self.tree.insert(2, 'two')
        self.tree.insert(1, 'one')
        self.tree.insert(3, 'three')

    def test_return_value_of_the_given_key(self):
        value = self.tree.get(2)
        self.assertEqual(value, 'two')

        value = self.tree.get(1)
        self.assertEqual(value, 'one')

        value = self.tree.get(3)
        self.assertEqual(value, 'three')


class BinarySearchTreeMinimumMaximumTestCase(unittest.TestCase):

    def setUp(self):
        self.tree = BinarySearchTree()
        self.tree.insert(7, 'seven')
        self.tree.insert(15, 'fifteen')
        self.tree.insert(8, 'eight')
        self.tree.insert(14, 'fourteen')

    def test_minimum_should_return_the_value_of_the_minimum_key_in_the_tree(self):
        minimum = self.tree.minimum()
        self.assertEqual(minimum, 'seven')

    def test_maximum_should_return_the_value_of_the_maximum_key_in_the_tree(self):
        maximum = self.tree.maximum()
        self.assertEqual(maximum, 'fifteen')


class BinarySearchTreeTraversalsTestCase(unittest.TestCase):

    def setUp(self):
        self.tree = BinarySearchTree()
        self.tree.insert(7, '7')
        self.tree.insert(4, '4')
        self.tree.insert(9, '9')
        self.tree.insert(2, '2')
        self.tree.insert(5, '5')
        self.tree.insert(8, '8')
        self.tree.insert(12, '12')

    def test_preorder_should_return_array_of_preordered_values(self):
        values = self.tree.traverse_preorder()
        expected = ['7', '4', '2', '5', '9', '8', '12']
        self.assertSequenceEqual(values, expected)

    def test_inorder_should_return_array_of_inordered_values(self):
        values = self.tree.traverse_inorder()
        expected = ['2', '4', '5', '7', '8', '9', '12']
        self.assertSequenceEqual(values, expected)

    def test_postorder_should_return_array_of_postordered_values(self):
        values = self.tree.traverse_postorder()
        expected = ['2', '5', '4', '8', '12', '9', '7']
        self.assertSequenceEqual(values, expected)


if __name__ == '__main__':
    unittest.main()
