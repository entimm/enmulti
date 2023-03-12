import json
import os
import subprocess
from typing import List

import sublime

ST3 = int(sublime.version()) > 3000
if ST3:
    PACKAGE_DIRECTORY = __name__.split('.')[0]
else:
    PACKAGE_DIRECTORY = os.path.basename(os.getcwd())

SETTINGS_FILE = 'Preferences.sublime-settings'
PHP_COMMAND = 'php'
RUN_PHP_SCRIPT = os.path.join(sublime.packages_path(), PACKAGE_DIRECTORY, 'php/run.php')


SETTINGS_FILE = "enmulti.sublime-settings"


def settings() -> sublime.Settings:
    """获取Sublime Text的首选项设置"""
    return sublime.load_settings(SETTINGS_FILE)


def selected_regions(view: sublime.View) -> List[sublime.Region]:
    """获取当前文本视图的选定区域"""
    sels = [sel for sel in view.sel() if not sel.empty()]

    if not sels:
        sels = [sublime.Region(0, view.size())]
    else:
        sels = view.sel()

    return sels


def get_settings(key: str, default=None):
    """获取Sublime Text的首选项设置"""
    return sublime.load_settings(SETTINGS_FILE).get(key, default)


def status_message(msg: str):
    """在状态栏显示一条消息"""
    print("%s" % (msg))
    sublime.status_message(msg)


def alert(message: str):
    """弹出警告对话框"""
    sublime.message_dialog(message)


def run_php(view: sublime.View, method: str='callback', callback: str='') -> None:
    """在PHP环境中运行指定的方法"""
    selections = [view.substr(region) for region in selected_regions(view)]
    data = json.dumps({'selections': selections, 'callback': callback})
    args = [
        PHP_COMMAND,
        RUN_PHP_SCRIPT,
        method,
        data
    ]

    print(args)
    try:
        proc = subprocess.Popen(args, stdout=subprocess.PIPE)
        output = proc.communicate()[0].decode('utf-8')
        texts = output.split('↩')
        view.run_command("replace_texts", {"texts": texts})
    except OSError as e:
        sublime.error_message('Error running PHP command - {e}')
