
/*
 * Module dependencies.
 */

var _ = require('lodash')

var db = require('./db')
var util = require('./util')

function main () {
  db.getAllNodes(function (err, nodes) {
    if (err) {
      console.log(err)
    } else {
      var existingNodes = _(_.pluck(nodes, 'name')).concat(
        _.pluck(nodes, 'node_number'))

      util.fetchLiveNodes(function (err, nodes) {
        if (err) {
          console.log(err)
        } else {
          var newNodes = []
          var oldNodes = []

          for (var i = 0; i < nodes.length; i++) {
            if (existingNodes.indexOf(nodes[i].name) > -1 ||
                existingNodes.indexOf(nodes[i].node_number) > -1) {
              oldNodes.push(nodes[i])
            } else {
              newNodes.push(nodes[i])
            }
          }

          for (var j = 0; j < newNodes.length; j++) {
            db.insertNode(newNodes[j], function (err) {
              if (err) {
                console.log(err)
              }
            })
          }

          for (var k = 0; k < oldNodes.length; k++) {
            db.incrementNodeUptime(oldNodes[k], function (err) {
              if (err) {
                console.log(err)
              }
            })
          }
        }
      })
    }
  })

  setTimeout(main, 1000 * 60 * 60)
}

main()
