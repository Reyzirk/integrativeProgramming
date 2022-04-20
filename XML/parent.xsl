<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : parent.xsl
    Created on : April 1, 2022, 12:39 AM
    Author     : Tang Khai Li
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
                <title>Parent Type</title>
            </head>
            <body>
                <xsl:apply-templates/>
            </body>
        </html>
    </xsl:template>
    
    <xsl:template match="parent">
        <table align="center" class="table table-hover">
            <tr>
                <th>No </th>
                <th>Type</th>
                <th>Short Form</th>
                <th>Description</th>
            </tr>
            <xsl:for-each select="parentType">     
                <tr>
                    <td>
                        <xsl:value-of select="type"/>
                    </td>
                    <td>
                        <xsl:value-of select="shortForm"/>
                    </td>
                    <td>
                        <xsl:value-of select="description"/>
                    </td>   
                </tr>               
            </xsl:for-each>
        </table>
    </xsl:template>
</xsl:stylesheet>
