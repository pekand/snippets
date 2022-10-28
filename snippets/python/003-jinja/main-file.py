from jinja2 import Environment, FileSystemLoader

max_score = 100
test_name = "Python Challenge"
students = [
    {"name": "Sandrine",  "score": 100},
]

environment = Environment(loader=FileSystemLoader("templates/"))
template = environment.get_template("template.txt")

for student in students:
    filename = f"out_{student['name'].lower()}.txt"
    content = template.render(
        student,
        max_score=max_score,
        test_name=test_name
    )
    with open(filename, mode="w", encoding="utf-8") as message:
        message.write(content)
        print(f"... wrote {filename}")
