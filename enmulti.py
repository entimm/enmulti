import os
import subprocess

from .lib import sublime_tools

import sublime
import sublime_plugin


class EnmultiCommand(sublime_plugin.TextCommand):
    """运行enmulti插件中的PHP方法"""

    def run(self, edit: sublime.Edit, method: str=None) -> None:
        sublime_tools.run_php(self.view, method)


class ReplaceTextsCommand(sublime_plugin.TextCommand):
    """替换当前选择区域中的文本内容"""

    def run(self, edit: sublime.Edit, texts: list=None) -> None:
        regions = self.view.sel()
        if texts and len(texts) >= len(regions):
            for i in range(len(regions)):
                self.view.replace(edit, regions[i], texts[i].strip())


class EnmultiSublCommand(sublime_plugin.TextCommand):
    """在新的Sublime Text窗口中打开指定目标文件"""

    def run(self, edit: sublime.Edit, target: str=None) -> None:
        args = ['subl', '-a', target]
        try:
            subprocess.Popen(args, stdout=subprocess.PIPE)
        except OSError as e:
            sublime.error_message('Error running Sublime Text command - {e}')


class EnmultiPromptCommand(sublime_plugin.TextCommand):
    """显示输入对话框，提示用户输入回调函数名称"""

    def run(self, edit: sublime.Edit, preview: bool=True) -> None:
        self.view.window().show_input_panel(
            "Enter callback:",
            '',
            self.on_done,
            None,
            None
        )

    def on_done(self, callback: str) -> None:
        sublime_tools.run_php(self.view, method='callback', callback=callback)
