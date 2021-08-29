
#incude files
include:
  - tools.git

vim:
  pkg.installed:
    - name: {{ salt['pillar.get']('pkgs:editor', 'vim') }}

