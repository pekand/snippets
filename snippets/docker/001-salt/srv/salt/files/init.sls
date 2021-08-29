/example:
  file.directory:
    - user: root
    - group: root
    - mode: 775

/example/template.conf:
  file.managed:
    - source: salt://files/template.conf
    - user: root
    - group: root
    - mode: 664

{% for file, path in pillar.get('files', {}).items() %}
{{path}}:
  file.managed:
    - source: salt://files/template.conf
    - user: root
    - group: root
    - mode: 664
{% endfor %}
