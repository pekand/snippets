using UnityEngine;

public class CubeRotator : MonoBehaviour
{
    public float stepSize = 1.0f;

    void Update()
    {
        if (Input.GetKey(KeyCode.UpArrow))
        {
            Move(Vector3.forward);
        }
        else if (Input.GetKey(KeyCode.DownArrow))
        {
            Move(Vector3.back);
        }
        else if (Input.GetKey(KeyCode.LeftArrow))
        {
            Move(Vector3.left);
        }
        else if (Input.GetKey(KeyCode.RightArrow))
        {
            Move(Vector3.right);
        }
    }

    private void Move(Vector3 direction)
    {
        transform.position += direction * stepSize;
    }
}
