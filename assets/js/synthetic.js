//////////////////////////////////////////////////////////////////////////////80
// Synthetic: Simple pulsing hexagonal background for websites
//////////////////////////////////////////////////////////////////////////////80
// Copyright (c) 2020 Liam Siira (liam@siira.io), distributed as-is and without
// warranty under the MIT License. See [root]/license.md for more.
// This information must remain intact.
//////////////////////////////////////////////////////////////////////////////80
// Copyright 2011 ZackTheHuman
// Source: https://gist.github.com/zackthehuman/1867663
//////////////////////////////////////////////////////////////////////////////80

class Synthetic {
    constructor() {
        this.colors = ["#0F0F0F", "#090909", "#0B0B0B", "#0D0D0D"];
        this.seed = 5309;
        this.canvas = document.getElementById('synthetic');
        this.rndColor = this.loadColors();
    }

    loadColors() {
        let storedColors = localStorage.getItem('synthetic');
        if (storedColors) {
            return JSON.parse(storedColors);
        }

        let randomColors = [];
        for (let i = 0; i < 5000; ++i) {
            randomColors.push(this.colors[this.randomIndex(this.colors.length)]);
        }
        localStorage.setItem('synthetic', JSON.stringify(randomColors));
        return randomColors;
    }

    randomIndex(max) {
        this.seed = (this.seed * 9301 + 49297) % 233280;
        return Math.floor(this.seed / 233280 * max);
    }

    drawSynthetic() {
        if (!this.canvas) return;

        const hex = this.calculateHexDimensions();
        this.canvas.width = Math.max(window.innerWidth, 2560) + (hex.rectangleWidth * 2);
        this.canvas.height = Math.max(window.innerHeight, 1440) + (hex.rectangleHeight * 2);

        const ctx = this.canvas.getContext('2d');
        if (ctx) {
            this.drawBoard(ctx, hex);
        }
    }

    calculateHexDimensions() {
        const angle = 0.523; // 30 degrees in radians
        const sideLength = 20;
        const height = Math.sin(angle) * sideLength;
        const radius = Math.cos(angle) * sideLength;
        const rectangleHeight = sideLength + 2 * height;
        const rectangleWidth = 2 * radius;

        return { height, radius, rectangleHeight, rectangleWidth, sideLength };
    }

    drawBoard(ctx, hex) {
        const boardWidth = this.canvas.width / hex.height;
        const boardHeight = this.canvas.height / hex.height;
        let i = 0;

        for (let x = 0; x < boardWidth; ++x) {
            for (let y = 0; y < boardHeight; ++y) {
                ctx.fillStyle = this.rndColor[(++i) % this.rndColor.length];
                this.drawHex(ctx, x, y, hex);
            }
        }
    }

    drawHex(ctx, x, y, hex) {
        const xPos = (x * 1.02) * hex.rectangleWidth + ((y % 2) * hex.radius);
        const yPos = (y * 1.02) * (hex.sideLength + hex.height);

        ctx.beginPath();
        ctx.moveTo(xPos + hex.radius, yPos);
        ctx.lineTo(xPos + hex.rectangleWidth, yPos + hex.height);
        ctx.lineTo(xPos + hex.rectangleWidth, yPos + hex.height + hex.sideLength);
        ctx.lineTo(xPos + hex.radius, yPos + hex.rectangleHeight);
        ctx.lineTo(xPos, yPos + hex.sideLength + hex.height);
        ctx.lineTo(xPos, yPos + hex.height);
        ctx.closePath();
        ctx.globalAlpha = 1;
        ctx.fill();
        ctx.globalAlpha = 0.2;
        ctx.stroke();
    }

    init() {
        window.addEventListener('DOMContentLoaded', () => this.drawSynthetic());
    }
}

const synthetic = new Synthetic();
synthetic.init();
