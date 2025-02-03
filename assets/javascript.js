// Simulated request handling
const request = window.location.pathname.split('/').pop(); // Simulating basename($_SERVER["REQUEST_URI"])
const urlParams = new URLSearchParams(window.location.search);
const jsParam = urlParams.get("js") ? urlParams.get("js").toLowerCase() : false;

// Mapping of short codes to file names
const filesMap = {
    "mn": "main",
    "ac": "activity",
    "an": "aeon",
    "ay": "anomaly",
    "ct": "contact",
    "eo": "echo",
    "ln": "lumin",
    "pm": "prism",
    "sc": "synthetic",
};

// Determine codes based on request
let codes;
if (request.includes("|")) {
    codes = request.split("|");
} else {
    codes = ['an', 'ct', 'ay', 'ac', 'ln', 'sc'];
}

// Ensure 'mn' is included and remove duplicates
codes.push("mn");
codes = [...new Set(codes)];

// Files to be processed
const filesToProcess = ["synthetic", "main"];
let buffer = "";

// Function to fetch and process JavaScript files
async function fetchAndProcessFiles() {
    for (const file of filesToProcess) {
        const response = await fetch(`js/${file}.js`);
        let content = await response.text();

        // Simulating the behavior of the original PHP code
        const needle = '//////////////////////////////////////////////////////////////////////////////80';
        const pos = content.lastIndexOf(needle) + 80;
        const block = content.substring(0, pos);
        content = content.substring(pos);

        // Remove comments and unnecessary whitespace
        content = content.replace(/\/\*[\s\S]*?\*\/|\/\/.*(?=\n)/g, ''); // Remove comments
        content = content.replace(/: /g, ':'); // Remove space after colons
        content = content.replace(/[\r\n\t]/g, ''); // Remove newlines and tabs

        buffer += `\n${block}\n\n${content}\n`;
    }

    const copyright = `//////////////////////////////////////////////////////////////////////////////80
// Psuedo compressed Javascript files
//////////////////////////////////////////////////////////////////////////////80\n`;

    // Output the final result
    const finalOutput = copyright + buffer;
    console.log(finalOutput); // You can replace this with any other output method
}

// Call the function to fetch and process files
fetchAndProcessFiles();
