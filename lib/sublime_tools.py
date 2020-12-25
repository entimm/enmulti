import json
import os
import subprocess

import sublime

ST3 = int(sublime.version()) > 3000
if ST3:
    PACKAGE_DIRECTORY = __name__.split('.')[0]
else:
    PACKAGE_DIRECTORY = os.path.basename(os.getcwd())


def selected_regions(view):
    sels = [sel for sel in view.sel() if not sel.empty()]

    if not sels:
        sels = [sublime.Region(0, view.size())]
    else:
        sels = view.sel()

    return sels


def get_settings(key, default=None):
    return settings().get(key, default)


def status_message(msg: str):
    print("%s" % (msg))
    sublime.status_message(msg)


def alert(message: str):
    sublime.message_dialog(message)


def run_php(view: sublime.View, method='callback', callback=''):
    selections = []
    for region in view.sel():
        selections.append(view.substr(region))

    data = json.dumps({'selections': selections, 'callback': callback})
    args = [
        'php',
        os.path.join(sublime.packages_path(), PACKAGE_DIRECTORY, 'php/run.php'),
        method,
        data
    ]

    print(args)
    try:
        proc = subprocess.Popen(args, stdout=subprocess.PIPE)
    except OSError:
        sublime.error_message('error occor!!!')
        return
    output = proc.communicate()[0]
    print('output:'+output.decode('utf8'))

    texts = output.decode('utf8').split('↩')
    view.run_command("replace_texts", {"texts": texts})
