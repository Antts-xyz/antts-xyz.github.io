document.addEventListener("DOMContentLoaded", () => {
  'use strict';

  class Logger {
    static log(message) {
      console.log(message);
    }
  }

  class DOMHelper {
    static select(selector) {
      return document.querySelector(selector);
    }

    static selectAll(selector) {
      return document.querySelectorAll(selector);
    }

    static updateTextContent(element, text) {
      if (element) {
        element.innerText = text;
      }
    }
  }

  class Application {
    static initialize() {
      Logger.log(`╭─────────────────────────────────╮\n│                                 │\n│           Hello World           │\n│                                 │\n╰─────────────────────────────────╯`);

      if (typeof Synthetic !== 'undefined' && typeof Synthetic.init === 'function') {
        Synthetic.init();
      }

      const footerText = DOMHelper.select('footer small');
      const currentYear = new Date().getFullYear();
      const copyrightText = `Copyright ${currentYear}, Antt1995`;
      DOMHelper.updateTextContent(footerText, copyrightText);
    }
  }

  Application.initialize();
});
