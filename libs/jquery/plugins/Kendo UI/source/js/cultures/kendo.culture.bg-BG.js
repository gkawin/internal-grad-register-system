﻿/*
* Kendo UI v2011.3.1215 (http://kendoui.com)
* Copyright 2011 Telerik AD. All rights reserved.
*
* Kendo UI commercial licenses may be obtained at http://kendoui.com/license.
* If you do not own a commercial license, this file shall be governed by the
* GNU General Public License (GPL) version 3. For GPL requirements, please
* review: http://www.gnu.org/copyleft/gpl.html
*/

﻿(function( window, undefined ) {
    kendo.cultures["bg-BG"] = {
        name: "bg-BG",
        numberFormat: {
            pattern: ["-n"],
            decimals: 2,
            ",": " ",
            ".": ",",
            groupSize: [3],
            percent: {
                pattern: ["-n %","n %"],
                decimals: 2,
                ",": " ",
                ".": ",",
                groupSize: [3],
                symbol: "%"
            },
            currency: {
                pattern: ["-n $","n $"],
                decimals: 2,
                ",": " ",
                ".": ",",
                groupSize: [3],
                symbol: "лв."
            }
        },
        calendars: {
            standard: {
                days: {
                    names: ["неделя","понеделник","вторник","сряда","четвъртък","петък","събота"],
                    namesAbbr: ["нед","пон","вт","ср","четв","пет","съб"],
                    namesShort: ["н","п","в","с","ч","п","с"]
                },
                months: {
                    names: ["януари","февруари","март","април","май","юни","юли","август","септември","октомври","ноември","декември",""],
                    namesAbbr: ["ян","февр","март","апр","май","юни","юли","авг","септ","окт","ноември","дек",""]
                },
                AM: [""],
                PM: [""],
                patterns: {
                    d: "d.M.yyyy 'г.'",
                    D: "dd MMMM yyyy 'г.'",
                    F: "dd MMMM yyyy 'г.' HH:mm:ss 'ч.'",
                    g: "d.M.yyyy 'г.' HH:mm 'ч.'",
                    G: "d.M.yyyy 'г.' HH:mm:ss 'ч.'",
                    m: "dd MMMM",
                    M: "dd MMMM",
                    s: "yyyy'-'MM'-'dd'T'HH':'mm':'ss",
                    t: "HH:mm 'ч.'",
                    T: "HH:mm:ss 'ч.'",
                    u: "yyyy'-'MM'-'dd HH':'mm':'ss'Z'",
                    y: "MMMM yyyy 'г.'",
                    Y: "MMMM yyyy 'г.'"
                },
                "/": ".",
                ":": ":",
                firstDay: 1
            }
        }
    }
})(this);