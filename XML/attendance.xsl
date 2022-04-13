<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : attendance.xsl
    Created on : April 13, 2022, 9:57 PM
    Author     : clhsk
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="/">
        <html>
            <head>
                <title>Temperature Declarations</title>
            </head>
            <body>
                <xsl:apply-templates/>
            </body>
        </html>
    </xsl:template>
    <xsl:template match="attendance">
        <table class="table table-hover " align="center">
            <tr style = "text-align: center">
                <th>No</th>
                <th>Temperature</th>
                <th>Code</th>
                <th>Description</th>
                <th>Safety Level</th>
            </tr>
            <xsl:for-each select="childTemperature">
                <tr>
                    
                    <xsl:if test="code = 'Green'">
                        <td class= "bg-success text-white">
                            <xsl:value-of select="position()"/>
                        </td>
                        <td class= "bg-success text-white" style="text-align: center">
                            <xsl:value-of select="temperature"/> &#8451;
                        </td>
                        <td class= "bg-success text-white">
                            <xsl:value-of select="code"/>
                        </td>
                        <td class= "bg-success text-white">
                            <xsl:value-of select = "description"/>
                        </td>
                        <td class= "bg-success text-white" style="text-align: center">
                            <xsl:value-of select = "safetyLevel"/>
                        </td>
                    </xsl:if>
                    
                    <xsl:if test="code = 'Yellow'">
                        <td class = "bg-warning">
                            <xsl:value-of select="position()"/>
                        </td>
                        <td class = "bg-warning" style="text-align: center">
                            <xsl:value-of select="temperature"/> &#8451;
                        </td>
                        <td class = "bg-warning">
                            <xsl:value-of select="code"/>
                        </td>
                        <td class = "bg-warning">
                            <xsl:value-of select = "description"/>
                        </td>
                        <td class = "bg-warning" style="text-align: center">
                            <xsl:value-of select = "safetyLevel"/>
                        </td>
                    </xsl:if>
                    
                    <xsl:if test="code = 'Orange'">
                        <td class = "bg-warning">
                            <xsl:value-of select="position()"/>
                        </td>
                        <td class = "bg-warning" style="text-align: center">
                            <xsl:value-of select="temperature"/> &#8451;
                        </td>
                        <td class = "bg-warning">
                            <xsl:value-of select="code"/>
                        </td>
                        <td class = "bg-warning">
                            <xsl:value-of select = "description"/>
                        </td>
                        <td class = "bg-warning" style="text-align: center">
                            <xsl:value-of select = "safetyLevel"/>
                        </td>
                    </xsl:if>
                    
                    <xsl:if test="code = 'Red'">
                        <td class="bg-danger text-white">
                            <xsl:value-of select="position()"/>
                        </td>
                        <td class="bg-danger text-white" style="text-align: center">
                            <xsl:value-of select="temperature"/> &#8451;
                        </td>
                        <td class="bg-danger text-white">
                            <xsl:value-of select="code"/>
                        </td>
                        <td class="bg-danger text-white">
                            <xsl:value-of select = "description"/>
                        </td>
                        <td class="bg-danger text-white" style="text-align: center">
                            <xsl:value-of select = "safetyLevel"/>
                        </td>
                    </xsl:if>
                </tr>
            </xsl:for-each>
        </table>
    </xsl:template>
</xsl:stylesheet>
