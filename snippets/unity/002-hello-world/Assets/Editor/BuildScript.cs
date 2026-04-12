using UnityEditor;
using UnityEditor.SceneManagement;
using UnityEngine;
using System.IO;

public class BuildScript
{
    public static void BuildWindows()
    {
        string scenePath = "Assets/MainScene.unity";

        // Delete the old scene to force a fresh one with the script attached
        if (File.Exists(scenePath)) { File.Delete(scenePath); }
        
        CreateHelloWorldScene(scenePath);

        // This sets the default window size for the built .exe
        PlayerSettings.defaultIsFullScreen = false;
        PlayerSettings.defaultScreenWidth = 800;
        PlayerSettings.defaultScreenHeight = 600;
        PlayerSettings.resizableWindow = true;

        BuildPlayerOptions buildOptions = new BuildPlayerOptions
        {
            scenes = new[] { scenePath },
            locationPathName = "Build/RotatingCube.exe",
            target = BuildTarget.StandaloneWindows64,
            options = BuildOptions.None
        };

        BuildPipeline.BuildPlayer(buildOptions);
    }

    private static void CreateHelloWorldScene(string path)
    {
        var newScene = EditorSceneManager.NewScene(NewSceneSetup.DefaultGameObjects, NewSceneMode.Single);
        
        // 1. Create Ground
        GameObject floor = GameObject.CreatePrimitive(PrimitiveType.Plane);
        floor.name = "Ground";
        floor.transform.position = new Vector3(0, -0.5f, 0);
        floor.transform.localScale = new Vector3(5, 1, 5);
        floor.GetComponent<Renderer>().material.color = Color.gray;

        GameObject cube = GameObject.CreatePrimitive(PrimitiveType.Cube);
        cube.transform.position = Vector3.zero;
        cube.name = "RobotCube";
        cube.GetComponent<Renderer>().material.color = Color.red;
        cube.AddComponent<CubeRotator>();

        // Add a light so it's not a dark blob
        GameObject lightGameObject = new GameObject("TheLight");
        Light lightPtr = lightGameObject.AddComponent<Light>();
        lightPtr.type = LightType.Directional;
        lightGameObject.transform.rotation = Quaternion.Euler(50, -30, 0);

        GameObject camera = GameObject.Find("Main Camera");
        if (camera != null)
        {
            camera.transform.position = new Vector3(2, 2, -4);
            camera.transform.LookAt(Vector3.zero);
        }

        EditorSceneManager.SaveScene(newScene, path);
    }
}