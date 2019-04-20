import os
import subprocess

from .lib import sublime_tools

import sublime
import sublime_plugin

SETTINGS_FILE = "enmulti.sublime-settings"

def settings():
    return sublime.load_settings(SETTINGS_FILE)

class Enmulti(sublime_plugin.TextCommand):
    def run(self, edit, method=None):
        sublime_tools.run_php(self.view, method)


class ReplaceTexts(sublime_plugin.TextCommand):
    def run(self, edit, texts=None):
        regions = self.view.sel()
        if texts and len(texts) >= len(regions):
            for i in range(len(regions)):
                self.view.replace(edit, regions[i], texts[i].strip())


class EnmultiSubl(sublime_plugin.TextCommand):
    def run(self, edit, target=None):
        args = ['subl', target]
        try:
            subprocess.Popen(args, stdout=subprocess.PIPE)
        except OSError:
            sublime.error_message('error occor!!!')
            return


class EnmultiPrompt(sublime_plugin.TextCommand):
    def run(self, edit, preview=True):
        self.view.window().show_input_panel(
            "Enter callback:",
            '',
            self.on_done,
            None,
            None
        )

    def on_done(self, callback):
        sublime_tools.run_php(self.view, method='callback', callback=callback)
