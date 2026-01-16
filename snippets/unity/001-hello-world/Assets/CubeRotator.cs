using UnityEngine;

public class CubeRotator : MonoBehaviour
{
    // High values so the rotation is obvious immediately
    public Vector3 rotationSpeed = new Vector3(45f, 90f, 15f);

    void Update()
    {
        // Rotating every frame
        transform.Rotate(rotationSpeed * Time.deltaTime);
    }
}
